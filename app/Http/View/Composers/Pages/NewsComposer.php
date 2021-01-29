<?php


namespace App\Http\View\Composers\Pages;


use App\Models\Page;
use App\Models\Post;
use Illuminate\View\View;

class NewsComposer implements \App\Http\View\Composers\ViewComposerInterface
{

    public function compose(View $view)
    {
        $featured = Post::featured()->published()->get();

        $page = Page::getPageBySlug('news');


        $view->with('title', $page->title ?? null);
        $view->with('meta_title', $page->meta_title ?? null);
        $view->with('meta_description', $page->meta_description ?? null);

        $view->with('featured', $featured ?? []);
    }
}
