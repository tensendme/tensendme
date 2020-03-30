<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\SettingControllerRequests\LinkStoreAndUpdateRequest;
use App\Models\Settings\Link;
use App\Services\v1\FileService;

class LinkController extends WebBaseController
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

    public function create() {
        $link = new Link();
        return view('admin.settings.links.create', compact('link'));
    }

    public function store(LinkStoreAndUpdateRequest $request) {
        $link = new Link;
        $link->title = $request->title;
        $link->url = $request->url;
        if($request->has('image')) {
            $path = $this->fileService->store($request->file('image'), 'image');
            $link->img_path = $path;
        }
        $link->save();
        $this->added();
        return redirect()->route('setting.index');
    }

    public function edit($id) {
        $link = Link::findOrFail($id);
        return view('admin.settings.links.edit', compact('link'));
    }

    public function update($id, LinkStoreAndUpdateRequest $request) {
        $link = Link::findOrFail($id);
        $link->title = $request->title;
        $link->url = $request->url;
        if($request->has('image')) {
            $path = $this->fileService->updateWithRemoveOrStore($request->file('image'), 'image', $link->img_path);
            $link->img_path = $path;
        }
        $link->save();
        $this->edited();
        return redirect()->route('setting.index');
    }

    public function visibleChange($id) {
        $link = Link::findOrFail($id);
        if ($link->is_visible) $link->is_visible = false;
        else $link->is_visible = true;
        $link->save();
        $this->edited();
        return redirect()->route('setting.index');
    }
}
