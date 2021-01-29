<?php


namespace App\Traits;


use App\Interfaces\SluggubleInterface;
use Spatie\Sluggable\HasSlug;

trait CheckSlug
{

    /**
     * Generate slug
     *
     * @param SluggubleInterface $model
     * @param string $slug
     * @param int $id
     * @return mixed
     */
    public function generateModelSlug(SluggubleInterface $model, string $slug, int $id = 0)
    {
        if($id) {
            $checker = $model::find($id);
            $checker->name = $slug;
        } else {
            $checker = new $model(['name' => $slug]);
        }
        $checker->generateSlug();

        return $checker->slug;
    }
}
