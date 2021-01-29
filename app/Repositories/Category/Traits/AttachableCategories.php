<?php


namespace App\Repositories\Category\Traits;


use App\Repositories\Category\Interfaces\CategorizedInterface;
use App\Repositories\Category\Models\Category;

trait AttachableCategories
{
    /**
     * Get list of attachable categories
     *
     * @param $type
     * @param array $requestedCategories
     * @param bool $all
     * @return mixed
     */
    public function getAttachableCategories(array $requestedCategories = [], $all = false)
    {
        return Category::when(!$all, function ($query) use ($requestedCategories) {
            return $query->whereIn('id', $requestedCategories);
        })
            ->where('related_to', get_class($this))
            ->where('behavior_type', $this->getAttachable())
            ->orderBy('id')
            ->pluck('id');
    }

    abstract public function getAttachable();
}
