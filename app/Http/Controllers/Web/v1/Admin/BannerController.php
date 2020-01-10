<?php

namespace App\Http\Controllers\Web\v1\Admin;


use App\Models\Banners\Banner;
use App\Models\News\Location;
use App\Models\News\News;
use Illuminate\Http\Request;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\BannerControllerRequests\StoreAndUpdateRequest;

use File;
class BannerController extends WebBaseController

{
    public function index() {
        $banners = Banner::paginate(10);
        return view('admin.banner.index', compact('banners'));
    }

    public function create() {
        $news = News::all();
        $locations = Location::all();
        $banner = new Banner();
        return view('admin.banner.create', compact( 'banner','locations','news'));
    }

    public function store(StoreAndUpdateRequest $request) {
        $path = '/banner/default.png';
        if($request->file('image')) {
            $filename = $request->title . time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/banner'), $filename);
            $path = '/banner/'.$filename;
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
        return view('admin.banner.edit', compact('banner','locations','news'));

    }

    public function update($id, StoreAndUpdateRequest $request) {
        $banner = Banner::findOrFail($id);
        $path = $banner->image_path;
        if($request->file('image')) {
            $filename = $request->title.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/banner'), $filename);
            $path = '/banner/'.$filename;
            if($banner->image_path != '/banner/default.png') File::delete('images/'.$banner->image_path);
        }

        $banner->update([
            'title'       => $request->title,
            'image_path'  => $path,
            'location_id' => $request->location_id,
            'news_id'     => $request->news_id,
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
