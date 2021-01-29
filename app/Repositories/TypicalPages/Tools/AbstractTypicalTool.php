<?php


namespace App\Repositories\TypicalPages\Tools;


abstract class AbstractTypicalTool
{
    public static array $rules = [];

    /**
     * Compile rules with prefix;
     *
     * @param string $prefix
     * @return array
     */
    public static function compileRules($prefix = ''): array
    {
//        $proxyArray = [];
//
//        foreach (static::$rules as $key => $rule) {
//            $proxyArray[$prefix . $key] = $rule;
//        }
//
//        return $proxyArray;

        return static::$rules;
    }
}
