<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 3.01.2020
 * Time: 23:32
 */

namespace App\Services\v1;


interface CabinetService
{
    public function findAll();
    public function statistic();
    public function findAllPaginated($pageSize = 10);
}
