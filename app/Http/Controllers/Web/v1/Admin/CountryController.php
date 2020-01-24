<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CountryControllerRequests\CountryStoreAndUpdateRequest;
use App\Models\Profiles\Country;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;


class CountryController extends WebBaseController
{

    protected $fileService;

    /**
     * CountryController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }


    public function create()
    {
        $country = new Country();
        return view('admin.country.create', compact('country'));
    }

    public function store(CountryStoreAndUpdateRequest $request)
    {
        $path = StaticConstants::DEFAULT_IMAGE;
        if ($request->file('image')) {
            $path = $this->fileService->store($request->file('image'), Country::DEFAULT_RESOURCE_DIRECTORY);
        }
        Country::create([
            'name' => $request->name,
            'phone_prefix' => $request->phone_prefix,
            'image_path' => $path
        ]);
        $this->added();
        return redirect()->route('country.index');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));

    }

    public function update(CountryStoreAndUpdateRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $path = $country->image_path;
        if ($request->file('image')) {
            $path = $this->fileService
                ->updateWithRemoveOrStore($request->file('image'), Country::DEFAULT_RESOURCE_DIRECTORY, $path);
        }
        $country->update([
            'name' => $request->name,
            'phone_prefix' => $request->phone_prefix,
            'image_path' => $path
        ]);
        $this->edited();
        return redirect()->route('country.index');
    }
}
