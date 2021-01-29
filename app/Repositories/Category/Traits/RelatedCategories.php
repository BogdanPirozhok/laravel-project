<?php


namespace App\Repositories\Category\Traits;


use App\Repositories\Category\Interfaces\CategorizedInterface;
use App\Repositories\Category\Models\Category;

trait RelatedCategories
{
    public static string $MASTER_BEHAVIOR = 'category';

    public static string $IS_PRIMARY_OWNER = 'filter';

    public static array $BEHAVIOR_TYPE_RELATION = [
        'category' => [
            'category',
            'filter'
        ],
        'filter' => [
            'parameter'
        ],
        'parameter' => [],
    ];

    public static function relatedToModelCategories()
    {
        return app('rinvex.categories.category')->where('related_to', get_class())->whereIn(array_keys(self::getBehavior()))->get();
    }

    /**
     * Return keys of behavior type relations
     *
     * @return array
     */
    public static function getBehavior()
    {
        return array_keys(self::$BEHAVIOR_TYPE_RELATION);
    }

    public static function getMasterBehavior()
    {
        return self::$MASTER_BEHAVIOR;
    }

    public static function getIsPrimaryOwner()
    {
        return self::$IS_PRIMARY_OWNER;
    }

    public static function getBehaviorTypeRelation()
    {
        return self::$BEHAVIOR_TYPE_RELATION;
    }
}
