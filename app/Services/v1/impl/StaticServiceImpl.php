<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:06
 */

namespace App\Services\v1\impl;


use App\Models\FAQs\Faq;
use App\Models\Profiles\Country;
use App\Models\Profiles\Level;
use App\Models\Settings\Link;
use App\Models\Settings\Setting;
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

    public function getAllFaqs()
    {
        return Faq::all();
    }

    public function aboutTensend()
    {
        $setting = Setting::first();
        $setting->makeHidden('id');
        $links = Link::where('is_visible', true)->get();
        $links->makeHidden(['is_visible', 'id']);
        $setting->links = $links;
        return $setting;
    }


}
