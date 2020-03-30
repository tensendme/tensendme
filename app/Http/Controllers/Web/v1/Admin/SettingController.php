<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\SettingControllerRequests\SettingUpdateRequest;
use App\Models\Settings\Link;
use App\Models\Settings\Setting;
use App\Services\v1\FileService;
use Illuminate\Http\Request;

class SettingController extends WebBaseController
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

    public function index(){
        $setting = Setting::first();
        $links = Link::all();
        return view('admin.settings.index', compact('setting', 'links'));
    }

    public function edit() {
        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(SettingUpdateRequest $request) {
        $setting = Setting::first();
        $setting->about_us = $request->about_us;
        $setting->title = $request->title;
        $setting->address = $request->address;

        $setting->phone = $request->phone;
        $setting->copyright = $request->copyright;
        if($request->has('logo')) {
            $path = $this->fileService->store($request->file('logo'), 'images');
            $setting->img_path = $path;
        }
        $setting->save();
        $this->edited();
        return redirect()->route('setting.index');
    }
}
