<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Models\Categories\Category;
use App\Exceptions\WebServiceErroredException;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\CategoryControllerRequests\StoreAndUpdateRequest;
use App\Models\Categories\CategoryType;
use App\Services\v1\CategoryService;
use Illuminate\Support\Facades\DB;
use Session;


class CategoryController extends WebBaseController
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
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


    public function store(StoreAndUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            Category::create($request->all());
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

    public function update(StoreAndUpdateRequest $request, $id)
    {
        Category::findOrFail($id)
            ->update($request->all());
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
