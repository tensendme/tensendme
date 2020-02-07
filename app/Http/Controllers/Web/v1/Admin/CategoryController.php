<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Models\Categories\Category;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CategoryControllerRequests\CategoryStoreAndUpdateRequest;
use App\Models\Categories\CategoryType;
use App\Models\Courses\Course;
use App\Services\v1\CategoryService;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;
use Illuminate\Support\Facades\DB;
use Session;


class CategoryController extends WebBaseController
{

    protected $categoryService;
    protected $fileService;
    public function __construct(CategoryService $categoryService, FileService $fileService)
    {
        $this->categoryService = $categoryService;
        $this->fileService = $fileService;
    }


    public function index()
    {
        $categories = $this->categoryService->findAllPaginated();
        return view('admin.category.index', compact('categories'));
    }


    public function create()
    {
        $categories = Category::all();
        $category = new Category();
        $categoryTypes = CategoryType::all();
        return view('admin.category.create', compact('categories', 'category', 'categoryTypes'));
    }


    public function store(CategoryStoreAndUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $path = StaticConstants::DEFAULT_IMAGE;
            if ($request->file('logo')) {
                $path = $this->fileService->store($request->file('logo'), Category::DEFAULT_RESOURCE_DIRECTORY);
            }
            Category::create([
                'parent_category_id' => $request->parent_category_id,
                'name' => $request->name,
                'category_type_id' => $request->category_type_id,
                'img_path' => $path
            ]);
            DB::commit();
            $this->added();
            return redirect()->route('category.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new WebServiceErroredException(trans('admin.error') . ': ' . $exception->getMessage());
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = Category::where('id', '<>', $id)->get();
        $category = Category::findOrFail($id);
        $categoryTypes = CategoryType::all();
        return view('admin.category.edit', compact('categories', 'category', 'categoryTypes'));

    }

    public function update(CategoryStoreAndUpdateRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $path = $category->img_path;
        if ($request->file('logo')) {
            $path = $this->fileService->updateWithRemoveOrStore($request->file('logo'),
                Category::DEFAULT_RESOURCE_DIRECTORY, $path);
        }
            $category->update([
                'parent_category_id' => $request->parent_category_id,
                'name' => $request->name,
                'category_type_id' => $request->category_type_id,
                'img_path' => $path
            ]);
        $this->edited();
        return redirect()->route('category.index');

    }

    public function destroy($id)
    {
        $child_category_ids = Category::where('parent_category_id', $id)->get('id');

        Category::destroy($child_category_ids);

        Category::destroy($id);

        $this->deleted();

        return redirect()->route('category.index');
    }
}
