<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 7.01.2020
 * Time: 10:20
 */

namespace App\Helpers;


class Helper
{
    public static function urlActiveHelper($routeName)
    {
        return strpos(request()->route()->getName(), $routeName) !== false ? " active " : "";
    }
}
