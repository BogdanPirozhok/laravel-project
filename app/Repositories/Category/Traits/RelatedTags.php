<?php


namespace App\Repositories\Category\Traits;


use App\Repositories\Category\Interfaces\Taggable;
use App\Repositories\Category\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;

trait RelatedTags
{
    public static string $TAG_BEHAVIOR = 'image_tag';

    /**
     * Get all attached categories to the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(config('rinvex.categories.models.category'), 'taggable', 'taggable', 'taggable_id', 'tag_id')
            ->withTimestamps();
    }

    /**
     * Sync REAL tags
     *
     * @param $ids
     * @param bool $detaching
     * @return array
     */
    public function syncTags($ids, $detaching = true)
    {
        return $this->tags()
            ->sync($ids, $detaching);
    }


    /**
     * Get list of attachable tags
     *
     * @param $requestedTags
     * @param Taggable $taggable
     * @return mixed
     */
    public static function getAttachableTags($requestedTags, Taggable $taggable)
    {
        return Category::whereIn('id',  is_null($requestedTags) ? [] : $requestedTags )
            ->where('related_to', get_class($taggable))
            ->where('behavior_type', self::$TAG_BEHAVIOR)
            ->pluck('id');
    }

}