<?php

namespace App\Models;

use App\Repositories\Category\Interfaces\CategorizedInterface;
use App\Repositories\Category\Interfaces\Packed;
use App\Repositories\Category\Interfaces\Taggable;
use App\Repositories\Category\Models\Category;
use App\Repositories\Category\Traits\AttachableCategories;
use App\Repositories\Category\Traits\RelatedCategories;
use App\Repositories\Category\Traits\RelatedTags;
use App\Repositories\Sanitizers\ProductRequestSanitizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Rinvex\Categories\Traits\Categorizable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements CategorizedInterface, Taggable, Packed
{
    use Categorizable;
    use RelatedCategories;
    use RelatedTags;
    use HasSlug;
    use HasTranslations;
    use AttachableCategories;


    const PRIMARY = 'filter';


    public $translatable = [
        'name',
        'meta_title',
        'meta_description',
        'material_title',
        'material_sub_title',
        'material_description',
    ];

    protected $fillable = [
        'name',
        'slug',
        'specs',
        'image_url',
        'is_popular',
        'is_published',
        'meta_title',
        'meta_description',
        'material_title',
        'material_sub_title',
        'material_description',
        'material_image_url'
    ];

    protected $appends = [
        'url'
    ];

    protected $casts = [
        'specs' => 'array'
    ];


    public function getAttachable(): string
    {
        return 'parameter';
    }


    /**
     * Get the options for generating the slug.
     *
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->doNotGenerateSlugsOnUpdate()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function similarProducts()
    {
        return $this->morphToMany(Product::class, 'similar_product', 'similar_products')
            ->withTimestamps();
    }


    public function similarRecipes()
    {
        return $this->morphToMany(Recipe::class, 'similar_product', 'similar_recipes')
            ->withTimestamps();
    }

    public function primaryCategory()
    {
        return $this->categories()->whereHas('parent', function ($query) {
            return $query->where('is_primary', true);
        });
    }

    public function package()
    {
        return $this->morphToMany(
            Category::class,
            'packageable',
            'packageable',
            'packageable_id',
            'package_id',
            'id',
            'id'
        )->withTimestamps();
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \App\Exceptions\CustomException
     * @throws \EditorJS\EditorJSException
     * @throws \App\Repositories\BodyBuilder\BodyBuilderException
     * @throws \App\Repositories\BodyBuilder\Exceptions\BodyBuilderException
     */
    public static function saveOrCreateProduct(Request $request)
    {
        $validated = ProductRequestSanitizer::validateEditor($request);

        $product = Product::find($validated['id']);

        if (is_null($product) && intval($request->get('id')) !== 0) {
            abort(404);
        }

        if (is_null($product)) {
            $product = Product::create($validated['data']);
        } else {
            $product->update($validated['data']);
        }

        self::syncRelations($product, self::extractVariables($request));

        return $product;
    }

    /**
     * Extract variables for polymorphic relations synchronization
     *
     * @param Request $request
     * @return array
     */
    public static function extractVariables(Request $request): array
    {
        if ($request->has('categories')) {
            $categories = (new Product)->getAttachableCategories($request->get('categories'));
        }
        if ($request->has('tags')) {
            $tags = self::getAttachableTags($request->get('tags'), new Product);
        }
        if ($request->has('package')) {
            $package = Category::package()->where('id', $request->get('package'))->get();
        }

        if ($request->has('similar_products')) {
            $products = Product::whereIn('id', is_null($request->get('similar_products')) ? [] : $request->get('similar_products'))
                ->pluck('id');
        }

        if ($request->has('similar_recipes')) {
            $recipes = Recipe::whereIn('id', is_null($request->get('similar_recipes')) ? [] : $request->get('similar_recipes'))
                ->pluck('id');
        }

        return [
            'categories'       => $categories ?? null,
            'tags'             => $tags ?? null,
            'package'          => $package ?? null,
            'similar_products' => $products ?? null,
            'similar_recipes'  => $recipes ?? null,
        ];
    }

    /**
     * Sync polymorphic relations
     *
     * @param Product $product
     * @param $params
     * @return Product
     */
    public static function syncRelations(Product $product, $params): Product
    {
        // extracting variables
        extract($params);

        if (isset($categories)) {
            $product->categories()->sync($categories);
        }

        if (isset($tags)) {
            $product->syncTags($tags);
        }

        if(isset($package)) {
            $product->package()->sync($package);
        }

        if (isset($similar_products)) {
            $product->similarProducts()->sync($similar_products);
        }

        if (isset($similar_recipes)) {
            $product->similarRecipes()->sync($similar_recipes);
        }

        return $product;
    }

    public function getUrlAttribute() {
        return url('product/'. $this->slug);
    }
}
