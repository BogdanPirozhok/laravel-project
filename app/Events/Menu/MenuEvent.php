<?php


namespace App\Events\Menu;


use App\Models\Menu;

abstract class MenuEvent
{
    /**
     * @var Menu
     */
    public Menu $menu;

    /**
     * MenuEvent constructor.
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }
}
