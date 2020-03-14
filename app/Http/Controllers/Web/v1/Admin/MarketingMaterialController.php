<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\MarketingMaterialControllerRequests\MarketingMaterialStoreAndUpdateRequest;
use App\Models\Marketing\MarketingMaterial;
use App\Services\v1\FileService;

class MarketingMaterialController extends WebBaseController
{

    protected $fileService;

    /**
     * MarketingMaterialController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function externalLink()
    {
        return view();
    }

    public function index()
    {
        $marketingMaterials = MarketingMaterial::all();
        return view('admin.marketingMaterial.index', compact('marketingMaterials'));
    }

    public function create()
    {
        $marketingMaterial = new MarketingMaterial();
        return view('admin.marketingMaterial.create', compact('marketingMaterial'));
    }

    public function store(MarketingMaterialStoreAndUpdateRequest $request)
    {
        $marketingMaterial = new MarketingMaterial();
        $marketingMaterial->name = $request->name;
        $marketingMaterial->url = $request->url;
        if ($request->file('image')) {
            $marketingMaterial->image_path = $this->fileService->updateWithRemoveOrStore($request->file('image'),
                MarketingMaterial::DEFAULT_RESOURCE_DIRECTORY,
                $marketingMaterial->image_path);
        }
        $marketingMaterial->save();
        $this->added();
        return redirect()->back();
    }

    public function edit($id)
    {
        $marketingMaterial = MarketingMaterial::find($id);
        if (!$marketingMaterial) {
            $this->notFound();
            return redirect()->back();
        }
        return view('admin.marketingMaterial.edit', compact('marketingMaterial'));

    }

    public function update($id, MarketingMaterialStoreAndUpdateRequest $request)
    {
        $marketingMaterial = MarketingMaterial::find($id);
        if (!$marketingMaterial) {
            $this->notFound();
            return redirect()->back();
        }
        $marketingMaterial->name = $request->name;
        $marketingMaterial->url = $request->url;
        if ($request->file('image')) {
            $marketingMaterial->image_path = $this->fileService->updateWithRemoveOrStore($request->file('image'),
                MarketingMaterial::DEFAULT_RESOURCE_DIRECTORY,
                $marketingMaterial->image_path);
        }
        $marketingMaterial->save();
        $this->added();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $marketingMaterial = MarketingMaterial::find($id);
        if (!$marketingMaterial) {
            $this->notFound();
            return redirect()->back();
        }

        if ($marketingMaterial->image_path) {
            $this->fileService->remove($marketingMaterial->image_path);
        }
        $marketingMaterial->delete();
        return redirect()->back();
    }
}
