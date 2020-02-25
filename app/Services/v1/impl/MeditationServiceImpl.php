<?php


namespace App\Services\v1\impl;

use App\Exceptions\ApiServiceException;
use App\Http\Errors\ErrorCode;
use App\Models\Meditations\Meditation;
use Auth;
use App\Services\v1\MeditationService;

class MeditationServiceImpl implements MeditationService
{
    public function findAll($perPage)
    {
        $meditations = Meditation::with('audios')->paginate($perPage);
        foreach ($meditations as $meditation) {
            $duration = $meditation->audios->first() ? $meditation->audios->first()->duration : 0;
            $meditation->duration_time = $duration;
            $meditation->makeHidden('audios');
        }
        return $meditations;
    }

    public function findById($id, $languageId = null)
    {
        $user = Auth::user();
        $subscription = $user->activeSubscriptions();
        $meditation = Meditation::where('id', $id)->with('audios')->first();
        if(!$meditation) {
            throw new ApiServiceException(404, false, [
                'errors' => ['Медитация не найдена'],
                'errorCode' => ErrorCode::RESOURCE_NOT_FOUND]);
        }
        $result = (object) array();
        $duration = 0;
        $result->name = $meditation->title;
        $result->description = $meditation->description;
        $result->description = $meditation->description;
        $result->img_path = $meditation->img_path;
        $result->access = $subscription->exists() ? true : false;
        $audios = array();
            foreach ($meditation->audios as $audio) {
                        $duration = $audio->duration;
                        $audio->access = $audio->free || $subscription->exists() ? true : false;
                        if(!$audio->free && !$subscription->exists())  {
                            $audio->audio_path = '';
                        }
                        $audio->makeHidden(['meditation_id', 'audio_language_id', 'author_id']);
        }
            $result->duration_time = $duration;
            $result->audios = $meditation->audios;
        return $result;
    }


}
