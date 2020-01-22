<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;


use App\Models\Profiles\Country;
use App\Services\v1\StaticService;

class StaticServiceImpl implements StaticService
{
    public function getAllCountries()
    {
        return Country::all();
    }

}