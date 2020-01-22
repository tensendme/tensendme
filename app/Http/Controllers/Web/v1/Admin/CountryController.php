<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CountryControllerRequests\StoreAndUpdateRequest;
use App\Models\Profiles\Country;


class CountryController extends WebBaseController
{

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

    public function store(StoreAndUpdateRequest $request)
    {
        Country::create($request->all());
        $this->added();
        return redirect()->route('country.index');
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));

    }

    public function update(StoreAndUpdateRequest $request, $id)
    {
        Country::findOrFail($id)
            ->update($request->all());
        $this->edited();
        return redirect()->route('country.index');
    }
}
