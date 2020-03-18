<?php


namespace App\Services\v1;


interface BannerService
{
    public function findAll();
    public function findAllLocations();
    public function findAllById($id);
    public function findAllByLocation($location);

    public function findAllPaginated($perPage);

}
