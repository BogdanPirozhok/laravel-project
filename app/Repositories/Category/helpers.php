<?php


if (! function_exists('array_values_recursive')) {
    function array_values_recursive($arr, $children = null)
    {
        $return = [];
        foreach ($arr as $key => $value)
        {
            if (is_array($value))
            {
                $arr[$key] = array_values_recursive($value, $children);
            }
        }

        if (isset($children))
        {
            $arr[$children] = array_values($arr[$children]);
        }

        return $arr;
    }
}