<?php

namespace App\Models;

use App\Events\Page\PageDeleted;
use App\Events\Page\PageSaved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Route;

class Page extends Model
{
    const IGNORABLE = [
        '{slug}',
        // yea. thats how we checks for empty '/' route
        '',
    ];


    protected $fillable = [
        'body',
        'slug',
        'title',
        'settings',
        'template_id',
        'meta_title',
        'description',
        'is_published',
        'meta_description',
        'custom_meta_tags',
        ];

    protected $casts = [
        'body' => 'array',
    ];

    protected $dispatchesEvents = [
        'saved' => PageSaved::class,
        'deleted'=> PageDeleted::class,
    ];



    public function template()
    {
        return $this->hasOne(Template::class, 'id', 'template_id');
    }

    public function combineVariables()
    {
        return [
            'body' => $this->body,
            'title' => $this->title,
            'meta_title' => $this->meta_title,
            'description' => $this->description,
            'meta_description' => $this->meta_description,
            'custom_meta_tags' => $this->custom_meta_tags,
        ];
    }

    /**
     * Check if slug exists in list of routes and slugs
     *
     * @param string $slug
     * @return bool
     */
    public static function checkSlug(string $slug): bool
    {
        return self::getListOfRoutes()->contains($slug);
    }


    /**
     * Return list of routes combined with slugs
     *
     * @param null $except
     * @return Collection
     */
    public static function getListOfRoutes(array $except = []): Collection
    {
        return collect(Route::getRoutes()->get())
            ->map(function($r) {
            return $r->uri();
            })
            ->merge(Page::all()->pluck('slug'))
            ->map(function($e) {
                return explode('/', $e)[0];
            })->reject(function($e) {
                return in_array($e, Page::IGNORABLE);
            })->unique()->filter(function($value, $key) use ($except) {
                return !in_array($value, $except);
            });
    }


    public static function getPageBySlug($slug)
    {
        return Cache::remember('page_' . $slug, 300, function() use ($slug) {
            return Page::where('slug', $slug)->first();
        });
    }

}
