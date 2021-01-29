<?php


namespace App\Traits;


trait ScopeTrait
{
    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
