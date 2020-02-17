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
        return Meditation::paginate($perPage);
    }

    public function findById($id, $languageId = null)
    {
        $user = Auth::user();
        $subscription = $user->activeSubscriptions();
        $meditation = Meditation::where('id', $id)->with('themes.audios')->first();
        if(!$meditation) {
            throw new ApiServiceException(404, false, [
                'errors' => ['Медитация не найдена'],
                'errorCode' => ErrorCode::RESOURCE_NOT_FOUND]);
        }
        $result = (object) array();
        $result->name = $meditation->title;
        $result->description = $meditation->description;
        $result->duration_time = $meditation->duration_time;
        $result->description = $meditation->description;
        $result->img_path = $meditation->img_path;
        $result->access = $subscription->exists() ? true : false;
        $result->audios = array();
        $i = 0;
        foreach ($meditation->themes as $theme) {
            foreach ($theme->audios as $audio) {
                if($languageId) {
                    if($audio->audio_language_id == $languageId) {
                        $result->audios[] = array(
                            'audio_path' => !$subscription->exists() && $i > 2 ?  '' : $audio->audio_path,
                            'title' => $theme->title,
                            'access' => $subscription->exists() ? true : false
                        );
                    }
                }
                else {
                    if($audio->audio_language_id == 2) {
                        $result->audios[] = array(
                            'audio_path' => !$subscription->exists() && $i > 2 ? '' : $audio->audio_path,
                            'title' => $theme->title,
                            'access' => $subscription->exists() ? true : false
                        );
                    }
                }
            }
            $i++;
        }
        return $result;
    }


}
