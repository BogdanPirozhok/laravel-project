<?php


namespace App\Repositories\Category\Interfaces;

interface CategorizedInterface
{
    public static function getBehavior();

    public static function relatedToModelCategories();

    public static function getMasterBehavior();

    public static function getIsPrimaryOwner();

    public static function getBehaviorTypeRelation();
}
