<?php

namespace App\Models;

use App\Interfaces\SluggubleInterface;
use App\Repositories\Category\Interfaces\CategorizedInterface;
use App\Repositories\Category\Traits\AttachableCategories;
use App\Repositories\Category\Traits\RelatedCategories;
use App\Repositories\Sanitizers\RecipeRequestSanitizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Rinvex\Categories\Traits\Categorizable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Recipe extends Model implements CategorizedInterface, SluggubleInterface
{
    use Categorizable;
    use RelatedCategories;
    use HasTranslations;
    use HasSlug;
    use AttachableCategories;

    public $translatable = [
        'name',
        'complexity',
        'cooking_time',
        'servings',
        'meta_description',
        'meta_title'
    ];

    protected $fillable = [
        'name',
        'body',
        'image_url',
        'complexity',
        'ingredients',
        'cooking_time',
        'servings',
        'meta_title',
        'meta_description',
        'slug',
        'is_published',
    ];

    protected $appends = [
        'url'
    ];


    protected $casts = [
        'body'        => 'array',
        'ingredients' => 'array'
    ];

    public function getAttachable(): string
    {
        return 'parameter';
    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function primaryCategory()
    {
        return $this->categories()->whereHas('parent', function ($query) {
            return $query->where('is_primary', true);
        });
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
            ->generateSlugsFrom(['name'])
            ->saveSlugsTo('slug');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \EditorJS\EditorJSException
     * @throws \App\Exceptions\CustomException
     */
    public static function saveOrCreateRecipe(Request $request)
    {
        $validated = RecipeRequestSanitizer::validateEditor($request);

        $recipe = Recipe::find($validated['id']);

        if (is_null($recipe) && intval($request->get('id')) !== 0) {
            abort(404);
        }

        if (is_null($recipe)) {
            $recipe = Recipe::create($validated['data']);
        } else {
            $recipe->update($validated['data']);
        }

        if($request->has('categories')) {
            $recipe->categories()->sync($recipe->getAttachableCategories(
                $request->get('categories')));
        }

        return $recipe;
    }

    public function getUrlAttribute() {
        return url('recipe/'. $this->slug);
    }
}
