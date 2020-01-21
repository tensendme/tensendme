<?php


namespace App\Services\v1;


interface NewsService
{
    public function findAll();
    public function findAllById($id);

    public function findAllPaginated($perPage);

}
