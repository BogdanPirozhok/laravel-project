<?php


namespace App\Http\View\Composers\Partials;


use App\Http\View\Composers\ViewComposerInterface;
use App\Models\Menu;
use Illuminate\View\View;

class NavbarComposer implements \App\Http\View\Composers\ViewComposerInterface
{

    public function compose(View $view)
    {
        $navbarMenu = Menu::getMenuByType('nav_menu');
        if($navbarMenu) {
            $navbarItems = Menu::buildTree($navbarMenu->navItems);
        }

        $mainItems = [];
        $subItems = [];

        foreach ($navbarItems ?? [] as $item) {
            $mainItems[] = $item;
            if(isset($item->children)) {
                $subItems[$item->id] = $item->children;
            }
        }

        $view->with('mainItems', $mainItems);
        $view->with('subItems', $subItems);
    }
}
