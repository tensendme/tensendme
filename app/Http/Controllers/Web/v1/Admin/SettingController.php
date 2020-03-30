<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings\Link;
use App\Models\Settings\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::first();
        $links = Link::all();
        return view('admin.settings.index', compact('setting', 'links'));
    }

    public function edit() {
        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update() {
        $setting = Setting::first();
        $setting->save();
    }
}
