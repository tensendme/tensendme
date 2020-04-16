<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\MeditationRequests\MeditationStoreAndUpdateRequest;
use App\Models\Categories\Category;
use App\Models\Meditations\Meditation;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MeditationController extends WebBaseController
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

    public function index() {
        $meditations = Meditation::orderBy('created_at', 'desc')->with('category')->paginate(10);
        $categories = Category::where('category_type_id', 2)->get();
        return view('admin.meditation.index', compact('meditations', 'categories'));
    }
    public function filter(Request $request) {
            $meditations = QueryBuilder::for(Meditation::class)
                ->allowedFilters(['title',
                    AllowedFilter::exact('category_id'),
                    AllowedFilter::exact('is_visible'),
                    AllowedFilter::scope('created_after'),
                    AllowedFilter::scope('created_before')
                ])
                ->defaultSort('-id')
                ->allowedIncludes(['category'])
                ->allowedSorts('id', 'created_at', 'title', 'is_visible', 'scale')
                ->paginate($request->perPage);

        return view('admin.meditation.table', compact('meditations'));
    }


    public function create(){
        $categories = Category::where('category_type_id', 2)
            ->doesntHave('childrens')
            ->get();
        $meditation = new Meditation();
        return view('admin.meditation.create', compact('categories', 'meditation'));
    }

    public function store(MeditationStoreAndUpdateRequest $request){
        $path = StaticConstants::DEFAULT_IMAGE;
        if ($request->file('image')) {
            $path = $this->fileService->store($request->file('image'), Meditation::DEFAULT_RESOURCE_DIRECTORY);
        }
        Meditation::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'img_path' => $path,
        ]);
        $this->added();
        return redirect()->route('meditation.index');
    }

    public function edit($id) {
        $categories = Category::where('category_type_id', 2)
            ->doesntHave('childrens')
            ->get();
        $meditation = Meditation::findOrFail($id);
        return view('admin.meditation.edit', compact('categories', 'meditation'));

    }

    public function update($id, MeditationStoreAndUpdateRequest $request){
        $meditation = Meditation::findOrFail($id);
        $path = $meditation->img_path;
        if ($request->file('image')) {
            $path = $this->fileService->updateWithRemoveOrStore(
                $request->file('image'), Meditation::DEFAULT_RESOURCE_DIRECTORY, $path);
        }

        $meditation->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'img_path' => $path,
        ]);
        $this->edited();
        return redirect()->route('meditation.index');
    }

    public function visibleChange($id)
    {

//        if (!Auth::user()->isAuthor()) {
            $meditation = Meditation::findOrFail($id);
//        } else {
//            $mditation = Course::where('author_id', Auth::id())->findOrFail($id);
//        }
        if ($meditation->is_visible) $meditation->is_visible = false;
        else $meditation->is_visible = true;
        $meditation->save();
        $this->edited();
        return redirect()->route('meditation.index');
    }
}
