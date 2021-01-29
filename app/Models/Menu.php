<?php

namespace App\Models;

use App\Events\Menu\MenuDeleted;
use App\Events\Menu\MenuSaved;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

/**
 * Class Menu
 * @package App\Models
 */
class Menu extends Model
{
    use HasTranslations;

    const NAV_MENU = 1;
    const MENU_ITEM = 2;

    const ITEM_TARGET = [
        '_self',
        '_blank',
        '_parent',
        '_self',
        '_top',
    ];

    public $translatable = [
        'item_caption',
        'item_description',
    ];

    protected $fillable = [
        'menu_name',
        'menu_position',
        'item_caption',
        'item_description',
        'item_icon',
        'item_target',
        'item_url',
        'item_menu_id',
        'taxonomy',
        'item_parent',
        'order',
    ];

    protected $dispatchesEvents = [
        'saved' => MenuSaved::class,
        'deleted' => MenuDeleted::class,
    ];


    /**
     * @param $query
     * @return mixed
     */
    public function scopeMenus($query)
    {
        return $query->where('taxonomy', Menu::NAV_MENU);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function navItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Menu::class, 'item_menu_id', 'id');
    }

    /**
     * @param $elements
     * @param int $parentId
     * @return array
     */
    public static function buildTree($elements, int $parentId = 0): array
    {
        $branch = array();

        foreach ($elements as &$element) {
            if ($element['item_parent'] == $parentId) {
                $children = self::buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
                unset($element);
            }
        }

        usort($branch, function ($a, $b) {
            return $a['order'] - $b['order'];
        });

        return $branch;
    }

    /**
     * @param $elements
     * @param $original
     * @param int|null $parentId
     * @param array $ids
     * @return array
     */
    public static function updateTree($elements, $original, int $parentId = null, array $ids = []): array
    {
        $iteratedIds = [];
        foreach ($elements as &$element) {
            if ($element['item_id'] === null) {
                $item = Menu::create([
                    'item_menu_id'     => $element['item_menu_id'],
                    'taxonomy'         => Menu::MENU_ITEM,
                    'item_parent'      => $parentId,
                    'item_description' => $element['item_description'],
                    'item_icon'        => $element['item_icon'],
                    'item_url'         => $element['item_url'],
                    'item_caption'     => $element['item_caption'],
                    'item_target'      => $element['item_target'],
                    'order'            => $element['order'],
                ]);
            }

            if (isset($element['children']) ? count($element['children']) : 0 >= 1) {
                $iteratedIds = array_merge(self::updateTree($element['children'], $original, isset($item) ? $item->id : $element['item_id'], $iteratedIds), $iteratedIds);
            }
            if (!isset($item)) {
                $item = $original->navItems->where('id', $element['item_id'])->first();
            }
            array_push($iteratedIds, $item->id);
            $item->item_caption = $element['item_caption'];
            $item->item_target = $element['item_target'];
            $item->item_description = $element['item_description'];
            $item->item_url = $element['item_url'];
            $item->item_icon = $element['item_icon'];
            $item->order = $element['order'];
            $item->item_parent = $parentId;
            $item->save();


            // variables need to delete at the and of iteration for not colliding in nested iteration
            unset($item);
            unset($element);
        }

        return $iteratedIds;
    }

    /**
     * Get menu though cache
     *
     * @param $menuType
     * @return mixed
     */
    public static function getMenuByType($menuType)
    {
        return Cache::remember($menuType, 300, function() use ($menuType) {
            return Menu::menus()->where('menu_position', $menuType)->with('navItems')->first();
        });
    }
}
