<?php


namespace App\Services\v1\impl;


use App\Models\Profiles\User;

class CabinetServiceImpl
{
    public function findAll()
    {
        return User::all();
    }
    public function statistic(){
        $result = array();

    }
}
