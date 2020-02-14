<?php


namespace App\Services\v1;


interface MeditationService
{
    public function findAll($perPage);
    public function findById($id, $languageId = null);
}
