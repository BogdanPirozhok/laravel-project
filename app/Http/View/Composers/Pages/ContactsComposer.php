<?php


namespace App\Http\View\Composers\Pages;


use App\Models\Page;
use Illuminate\View\View;

class ContactsComposer implements \App\Http\View\Composers\ViewComposerInterface
{

    public function compose(View $view)
    {
        $page = Page::getPageBySlug('contacts');

        $view->with('title', $page->title ?? null);
        $view->with('meta_title', $page->meta_title ?? null);
        $view->with('meta_description', $page->meta_description ?? null);

        $view->with('body', $page->body ?? []);
    }
}
