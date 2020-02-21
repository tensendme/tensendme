<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\MeditationRequests\AudioRequest;
use App\Models\Meditations\AudioLanguage;
use App\Models\Meditations\MeditationAudio;
use App\Services\v1\FileService;

class MeditationAudioController extends WebBaseController
{
    protected $fileService;

    /**
     * CourseController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index($meditationId) {
        $audios = MeditationAudio::where('meditation_id', $meditationId)
            ->with('language')
            ->with('author')->get();
        return view('admin.meditation.audios.index', compact('audios', 'meditationId'));
    }


    public function create($meditationId) {
        $audio = new MeditationAudio();
        if(!empty($audio)) $audio = null;
        $languages = AudioLanguage::all();
        return view('admin.meditation.audios.create', compact('languages', 'meditationId', 'audio'));
    }

    public function store($meditationId, AudioRequest $request) {
        if(!$request->audio) throw new WebServiceErroredException(trans('admin.error') . ': Аудио не должно быть пустым!');
        $path = $this->fileService->meditationAudioStore($request->audio, MeditationAudio::DEFAULT_RESOURCE_DIRECTORY);
        MeditationAudio::create([
            'duration' => ceil($path->duration),
            'audio_path' => $path->path,
            'audio_language_id' => $request->language_id,
            'author_id' => $request->author_id,
            'meditation_id' => $meditationId,
            'free' => $request->access ? true : false
        ]);
        $this->added();
        return redirect()->route('meditation.audio.index', ['meditationId' => $meditationId]);
    }

    public function edit($id) {
        $audio = MeditationAudio::find($id);
        $languages = AudioLanguage::all();
        return view('admin.meditation.audios.edit', compact('languages', 'audio'));
    }

    public function update($id, AudioRequest $request) {
        $audio = MeditationAudio::find($id);
        $audio->audio_language_id = $request->language_id;
        $audio->author_id = $request->author_id;
        $audio->free = $request->access ? true : false;

        if($request->audio) {
            $path = (object) array();
            $path->duration = $audio->duration;
            $path->path = $audio->audio_path;
            $path = $this->fileService->meditationAudioUpdate($request->audio,
                MeditationAudio::DEFAULT_RESOURCE_DIRECTORY, $path->path);
            $audio->audio_path = $path->path;
            $audio->duration = ceil($path->duration/60);
        }
        $audio->save();
        $this->edited();
        return redirect()->route('meditation.audio.index', ['meditationId' => $audio->meditation_id]);

    }
}
