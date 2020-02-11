<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\MeditationRequests\ThemeStoreAndUpdateRequest;
use App\Models\Meditations\AudioLanguage;
use App\Models\Meditations\Meditation;
use App\Models\Meditations\Theme;
use App\Models\Meditations\ThemeAudio;
use App\Services\v1\FileService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\WebServiceErroredException;
use File;


class MeditationThemeController extends WebBaseController
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
        $themes = Theme::with('audios')->where('meditation_id', $meditationId)->get();
        return view('admin.meditation.theme.index', compact('themes', 'meditationId'));
    }

    public function create($meditationId){
        $theme = new Theme();
        $audioTypes = AudioLanguage::all();
        return view('admin.meditation.theme.create', compact('theme', 'meditationId', 'audioTypes'));
    }

    public function store($meditationId, ThemeStoreAndUpdateRequest $request) {
        DB::beginTransaction();
        try {
            $theme = Theme::create([
                'meditation_id' => $meditationId,
                'title' => $request->title
            ]);
            if($request->audio) {
                foreach ($request->audio as $audioLanguageId => $audio) {
                    $path = $this->fileService->store($audio, ThemeAudio::DEFAULT_RESOURCE_DIRECTORY);
                    ThemeAudio::create([
                        'theme_id' => $theme->id,
                        'audio_path' => $path,
                        'audio_language_id' => $audioLanguageId
                    ]);
                }
            }
            DB::commit();
            $this->added();
            return redirect()->route('meditation.theme.index', compact('meditationId'));
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new WebServiceErroredException(trans('admin.error') . ': ' . $exception->getMessage());
        }
    }

    public function edit($id) {
        $theme = Theme::findOrFail($id);
        $audioTypes = AudioLanguage::all();
        return view('admin.meditation.theme.edit', compact('theme', 'audioTypes'));
    }

    public function update($id, ThemeStoreAndUpdateRequest $request) {
        $theme = Theme::findOrFail($id);
        $meditationId = $theme->meditation_id;
        DB::beginTransaction();
        try {
            $theme->update([
                'title' => $request->title
            ]);
            if($request->audio) {
                foreach ($request->audio as $audioLanguageId => $audio) {
                    $themeAudio = ThemeAudio::where('theme_id', $theme->id)
                        ->where('audio_language_id', $audioLanguageId)->first();
                    if($themeAudio) {
                        $path = $themeAudio->audio_path;
                        $path = $this->fileService->updateWithRemoveOrStore(
                            $audio, ThemeAudio::DEFAULT_RESOURCE_DIRECTORY, $path);
                        $themeAudio->audio_path = $path;
                        $themeAudio->save();
                    }
                    else {
                        $path = $this->fileService->store(
                            $audio, ThemeAudio::DEFAULT_RESOURCE_DIRECTORY);
                        ThemeAudio::create([
                            'theme_id' => $id,
                            'audio_path' => $path,
                            'audio_language_id' => $audioLanguageId
                        ]);
                    }
                }
            }
            DB::commit();
            $this->edited();
            return redirect()->route('meditation.theme.index', compact('meditationId'));
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new WebServiceErroredException(trans('admin.error') . ': ' . $exception->getMessage());
        }
    }
}
