<?php


namespace App\Services\v1\impl;

use App\Models\Meditations\Meditation;

use App\Services\v1\MeditationService;

class MeditationServiceImpl implements MeditationService
{
    public function findAll($perPage)
    {
        return Meditation::paginate($perPage);
    }
}
