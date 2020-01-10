<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\NewsControllerRequests\StoreAndUpdateRequest;

use App\Models\News\News;
use File;

class NewsController extends WebBaseController
{
    public function index() {
        $news = News::paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create() {

        $news = new News();
        return view('admin.news.create', compact('news'));
    }

    public function store(StoreAndUpdateRequest $request) {
        $path = '/news/default.png';
        if($request->file('image')) {
            $filename = $request->title.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/news'), $filename);
            $path = '/news/'.$filename;
        }
        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
        ]);
        $this->added();
        return redirect()->route('news.index');
    }

    public function edit($id)
    {

        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));

    }

    public function update($id, StoreAndUpdateRequest $request) {
        $news = News::findOrFail($id);
        $path = $news->image_path;
        if($request->file('image')) {
            $filename = $request->title.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/news'), $filename);
            $path = '/news/'.$filename;
            if($news->image_path != '/news/default.png') File::delete('images/'.$news->image_path);
        }
        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path
        ]);
        $this->edited();
        return redirect()->route('news.index');
    }

    public function destroy($id)
    {
        News::destroy($id);

        $this->deleted();

        return redirect()->route('news.index');
    }

}
