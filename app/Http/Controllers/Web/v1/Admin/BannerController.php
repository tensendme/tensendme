<?php

namespace App\Http\Controllers\Web\v1\Admin;


use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\BannerControllerRequests\BannerStoreAndUpdateRequest;
use App\Models\Banners\Banner;
use App\Models\News\Location;
use App\Models\News\News;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;

class BannerController extends WebBaseController
{
    protected $fileService;

    /**
     * BannerController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function index()
    {
        $banners = Banner::paginate(10);
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        $news = News::all();
        $locations = Location::all();
        $banner = new Banner();
        return view('admin.banner.create', compact('banner', 'locations', 'news'));
    }

    public function store(BannerStoreAndUpdateRequest $request)
    {
        $path = StaticConstants::DEFAULT_IMAGE;
        if ($request->file('image')) {
            $path = $this->fileService->store($request->file('image'), Banner::DEFAULT_RESOURCE_DIRECTORY);
        }
        Banner::create([
            'title' => $request->title,
            'news_id' => $request->news_id,
            'image_path' => $path,
            'location_id' => $request->location_id,

        ]);
        $this->added();
        return redirect()->route('banner.index');
    }

    public function edit($id)
    {
        $news = News::all();
        $locations = Location::all();
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner', 'locations', 'news'));

    }

    public function update($id, BannerStoreAndUpdateRequest $request)
    {
        $banner = Banner::findOrFail($id);
        $path = $banner->image_path;
        if ($request->file('image')) {
            $path = $this->fileService
                ->updateWithRemoveOrStore($request->file('image'), Banner::DEFAULT_RESOURCE_DIRECTORY, $path);
        }

        $banner->update([
            'title' => $request->title,
            'image_path' => $path,
            'location_id' => $request->location_id,
            'news_id' => $request->news_id,
        ]);
        $this->edited();
        return redirect()->route('banner.index');
    }

    public function destroy($id)
    {
        Banner::destroy($id);
        $this->deleted();
        return redirect()->route('banner.index');
    }


}
