<?php


namespace App\Helpers;


class LocaleHelper
{
    public static function localesByCase($case = 'short')
    {
        return array_column(config('locale.languages'), $case);
    }

    public static function locales()
    {
        return config('locale.languages');
    }

}
