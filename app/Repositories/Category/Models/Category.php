<?php

namespace App\Repositories\Category\Models;

use App\Exceptions\CustomException;
use App\Interfaces\SluggubleInterface;
use App\Repositories\Category\Exceptions\WrongBehaviorType;
use App\Repositories\Category\Exceptions\WrongIsPrimaryOwner;
use App\Repositories\Category\Exceptions\WrongParentChildModelRelation;
use App\Repositories\Category\Interfaces\CategorizedInterface;
use App\Repositories\Category\Interfaces\Packed;
use App\Repositories\Category\Interfaces\Taggable;
use Illuminate\Http\Request;
use Kalnoy\Nestedset\NestedSet;
use Rinvex\Categories\Models\Category as RinvexCategory;


class Category extends RinvexCategory implements SluggubleInterface
{
    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'slug',
        'name',
        'description',
        NestedSet::LFT,
        NestedSet::RGT,
        NestedSet::PARENT_ID,
        'is_published',
        'behavior_type',
        'related_to',
        'image_url',
        'is_primary',
        'meta_title',
        'meta_description',
    ];


    public $translatable = [
        'name',
        'description',
        'meta_title',
        'meta_description'
    ];


    /**
     * Create category based on request
     *
     * @param Request $request
     * @param CategorizedInterface|null $model
     * @return mixed
     * @throws WrongBehaviorType
     * @throws WrongParentChildModelRelation
     * @throws WrongIsPrimaryOwner
     */
    public static function createCategory(Request $request, CategorizedInterface $model = null)
    {
        if ($request->get('parent_id')) {
            $parent = Category::find($request->get('parent_id'));
            if (!in_array($request->get('behavior_type'), $model::getBehaviorTypeRelation()[$parent->behavior_type])) {
                throw new WrongBehaviorType(__('category.wrong_behavior'));
            }
            if ($parent->related_to !== get_class($model)) {
                throw new WrongParentChildModelRelation(__('category.wrong_relation'));
            }
        } else {
            if ($request->get('behavior_type') !== $model::getMasterBehavior()) {
                throw new WrongBehaviorType(__('category.wrong_behavior'));
            }
        }

        if ( filter_var($request->get('is_primary'), FILTER_VALIDATE_BOOLEAN) && $request->get('behavior_type') !== $model::getIsPrimaryOwner() ) {
            throw new WrongIsPrimaryOwner(__('category.wrong_is_primary_owner'));
        }

        $validated = $request->validated();
        unset($validated['is_primary']);
        $category = Category::create(array_merge($validated, ['related_to' => get_class($model)]));
        if( filter_var($request->get('is_primary'), FILTER_VALIDATE_BOOLEAN)) {
            $category->setPrimary();
        }

        return $category;
    }

    /**
     * @param Request $request
     * @param Taggable|null $model
     * @return mixed
     */
    public static function createTag(Request $request, Taggable $model = null)
    {
        $validated = $request->validated();

        $validated['image_url'] = self::checkImageHost($request->get('image_url'));

        return Category::create(
            array_merge(
                $validated,
                ['related_to' => get_class($model), 'behavior_type' => 'image_tag']
            )
        );
    }

    public static function updateTag(Category $tag, Request $request)
    {
        $validated = $request->validated();

        if ($request->has('image_url'))
            $validated['image_url'] = self::checkImageHost($request->get('image_url'));

        return $tag->update(
            array_merge(
                $validated
            )
        );
    }

    public static function createPackaging(Request $request, Packed $model = null)
    {
        $validated = $request->validated();

        if ($request->has('image_url'))
            $validated['image_url'] = self::checkImageHost($request->get('image_url'));


        return Category::create(array_merge($validated, ['behavior_type' => 'product_package', 'related_to' => get_class($model)]));
    }

    private static function checkImageHost($imageUrl)
    {
        $parsed = parse_url($imageUrl);
        return $parsed['host'] === parse_url(config('app.url'))['host'] ? $parsed['path'] : $imageUrl;
    }

    public function scopeTags($query)
    {
        return $query->where('behavior_type', 'image_tag');
    }

    public function scopePackage($query)
    {
        return $query->where('behavior_type', 'product_package');
    }

    /**
     * Set is_primary for category and unset for others
     *
     * @return $this
     * @throws \Exception
     */
    public function setPrimary()
    {
        if ($this->behavior_type !== 'filter') {
            throw new CustomException('You can change is_primary only for filters', 422);
        }
        $res = Category::where('behavior_type', 'filter')
            ->whereNotIn('id', [$this->id])
            ->where('parent_id', $this->parent_id)->update(['is_primary' => false]);


        $this->update(['is_primary' => true]);

        return $this;
    }
}
