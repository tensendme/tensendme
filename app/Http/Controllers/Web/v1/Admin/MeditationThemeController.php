<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\MeditationRequests\ThemeStoreAndUpdate;
use App\Models\Meditations\AudioLanguage;
use App\Models\Meditations\Theme;
use App\Models\Meditations\ThemeAudio;

class MeditationThemeController extends Controller
{
    public function index($meditationId) {
        $themes = Theme::with('audios')->where('meditation_id', $meditationId)->get();
        return view('admin.meditation.theme.index', compact('themes', 'meditationId'));
    }

    public function create($meditationId){
        $theme = new Theme();
        $audioTypes = AudioLanguage::all();
        return view('admin.meditation.theme.create', compact('theme', 'meditationId', 'audioTypes'));
    }

    public function store($meditationId, ThemeStoreAndUpdate $request) {
        $theme = Theme::create([
            'meditation_id' => $meditationId,
            'title' => $request->title
        ]);
        $audioTypes = AudioLanguage::all();
        foreach ($audioTypes as $audioType) {
            ThemeAudio::create([
                'theme_id' => $theme->id,
                'audio_path' => 'asdasd',
                'audio_language_id' => $audioType->id
            ]);
//            $request->audio[$audioType->id];
        }
        return redirect()->route('meditation.theme.index', compact('meditationId'));
    }
}
