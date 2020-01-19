<?php

namespace App\Http\Controllers\Web\v1\Admin;


use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\FAQControllerRequests\StoreAndUpdateRequest;

use App\Models\FAQs\Faq;
use File;


class FAQController extends WebBaseController
{
    public function index() {
        $faqs = Faq::paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }

    public function create() {

        $faq = new Faq();
        return view('admin.faq.create', compact('faq'));
    }

    public function store(StoreAndUpdateRequest $request) {
        $path = '/news/default.png';
        if($request->file('image')) {
            $filename = $request->title.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/faqs'), $filename);
            $path = '/faqs/'.$filename;
        }
        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'image_path' => $path,
        ]);
        $this->added();
        return redirect()->route('faq.index');
    }

    public function edit($id)
    {

        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));

    }

    public function update($id, StoreAndUpdateRequest $request) {
        $faq = Faq::findOrFail($id);
        $path = $faq->image_path;
        if($request->file('image')) {
            $filename = $request->title.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images/faqs'), $filename);
            $path = '/faqs/'.$filename;
            if($faq->image_path != '/faqs/default.png') File::delete('images/'.$faq->image_path);
        }
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'image_path' => $path
        ]);
        $this->edited();
        return redirect()->route('faq.index');
    }

    public function destroy($id)
    {
        Faq::destroy($id);

        $this->deleted();

        return redirect()->route('faq.index');
    }
}
