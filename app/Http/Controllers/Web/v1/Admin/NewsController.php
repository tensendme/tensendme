<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\NewsControllerRequests\NewsStoreAndUpdateRequest;
use App\Models\News\News;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;

class NewsController extends WebBaseController
{
    protected $fileService;

    /**
     * NewsController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function index()
    {
        $news = News::paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {

        $news = new News();
        return view('admin.news.create', compact('news'));
    }

    public function store(NewsStoreAndUpdateRequest $request)
    {
        $path = StaticConstants::DEFAULT_IMAGE;
        if ($request->file('image')) {
            $path = $this->fileService->store($request->file('image'), News::DEFAULT_RESOURCE_DIRECTORY);
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

    public function update($id, NewsStoreAndUpdateRequest $request)
    {
        $news = News::findOrFail($id);
        $path = $news->image_path;
        if ($request->file('image')) {
            $path = $this->fileService
                ->updateWithRemoveOrStore($request->file('image'), News::DEFAULT_RESOURCE_DIRECTORY, $path);
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
