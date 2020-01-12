<?php


namespace App\Services\v1;


interface BannerService
{
    public function findAll();
    public function findAllById($id);
    public function findAllByLocation($location_id);

    public function findAllPaginated($pageSize = 10, $page = 0);

}
