<?php


namespace App\Repositories\Category\Traits;


trait RelatedTaxonomies
{
    public static function getBehavior()
    {
        return [self::getMasterBehavior()];
    }

    public static function relatedToModelCategories()
    {
        return app('rinvex.categories.category')->where('related_to', get_class())->whereIn('behavior_type', self::getBehavior())->get();
    }

    public static function getMasterBehavior()
    {
        return 'taxonomy';
    }

    public static function getIsPrimaryOwner()
    {
        return null;
    }

    public static function getBehaviorTypeRelation()
    {
        return null;
    }
}
