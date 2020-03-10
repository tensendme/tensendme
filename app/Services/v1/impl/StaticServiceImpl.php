<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;


use App\Models\Profiles\Country;
use App\Models\Profiles\Level;
use App\Services\v1\StaticService;

class StaticServiceImpl implements StaticService
{
    public function getAllCountries()
    {
        return Country::all();
    }

    public function getLevels()
    {
        return Level::all();
    }


}
