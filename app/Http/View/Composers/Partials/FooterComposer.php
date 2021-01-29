<?php


namespace App\Http\View\Composers\Partials;


use App\Http\View\Composers\ViewComposerInterface;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class FooterComposer implements ViewComposerInterface
{

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $footerMenu = Menu::getMenuByType('footer_menu');

        if($footerMenu) {
            $footerItems = Menu::buildTree($footerMenu->navItems);
        }

        $socialMenu = Menu::getMenuByType('social_menu');

        if($socialMenu) {
            $socialItems = Menu::buildTree($socialMenu->navItems);
        }

        $view->with('footer_menu', $footerItems ?? []);
        $view->with('social_menu', $socialItems ?? []);
    }

}
