<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Services\v1\CategoryService;
use Illuminate\Http\Request;
use Session;



class CategoryController extends Controller
{

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        $categories = $this->categoryService->findAll();
        return view('admin/category/index', compact('categories'));
    }


    public function create()
    {   $categories = Category::all();
        return view('admin.categories.create')
            ->with('categories',$categories);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=> 'required',
            'type'=>'required',
        ]);

        $category = Category::create([
            'name'=>$request->name,
            'type'=>$request->type,
            'parent_category_id'=>$request->parent_category_id

        ]);

        $category->save();

        Session::flash('success','Category created successfully');

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = Category::all();
        return view('admin.categories.edit')
            ->with('categories',$categories)
            ->with('category', Category::findOrFail($id));

    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name'=> 'required',
            'type'=>'required',
        ]);

        Category::findOrFail($id)
            ->update([
                'name'=>$request->name,
                'type'=>$request->type,
                'parent_category_id'=>$request->parent_category_id
            ]);
//        $category->name = $request->name;
//        $category->type = $request->type;
//        $category->parent_category_id = $request->parent_category_id;
//        $category->save();

        Session::flash('success','Category updated successfully');

        return redirect()->route('categories.index');

    }

    public function destroy($id)
    {
        $child_category_ids = Category::where('parent_category_id', $id)->get('id');

        Category::destroy($child_category_ids);

        Category::destroy($id);

        Session::flash('success','Category deleted successfully');

        return redirect()->route('categories.index');
    }
}
