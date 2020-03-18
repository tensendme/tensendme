<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 22.01.2020
 * Time: 13:05
 */

namespace App\Services\v1;


interface StaticService
{
    public function getAllCountries();
    public function getLevels();
    public function getAllFaqs();
}
