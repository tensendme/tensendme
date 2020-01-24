<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\MeditationRequests\MeditationStoreAndUpdateRequest;
use App\Models\Categories\Category;
use App\Models\Meditations\Meditation;

class MeditationController extends WebBaseController
{
    public function index() {
        $meditations = Meditation::paginate(10);
        return view('admin.meditation.index', compact('meditations'));
    }

    public function create(){
        $categories = Category::where('category_type_id', 2)->get();
        $meditation = new Meditation();
        return view('admin.meditation.create', compact('categories', 'meditation'));
    }

    public function store(MeditationStoreAndUpdateRequest $request){
        Meditation::create($request->all());
        $this->added();
        return redirect()->route('meditation.index');
    }

    public function edit($id) {
        $categories = Category::where('category_type_id', 2)->get();
        $meditation = Meditation::findOrFail($id);
        return view('admin.meditation.edit', compact('categories', 'meditation'));

    }

    public function update($id, MeditationStoreAndUpdateRequest $request){
        Meditation::findOrFail($id)->update($request->all());
        $this->edited();
        return redirect()->route('meditation.index');
    }
}
