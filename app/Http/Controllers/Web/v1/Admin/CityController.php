<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use Illuminate\Http\Request;
use App\Models\Profiles\City;
use App\Models\Profiles\Country;
use App\Http\Requests\Web\V1\CityControllerRequests\CityStoreAndUpdateRequest;



class CityController extends WebBaseController
{
    public function index($pageSize =10)
    {
        $cities = City::paginate($pageSize);

        return view('admin.city.index',compact('cities'));
    }


    public function create()
    {
        $countries = Country::all();
        $city = new City();

        return view('admin.city.create', compact('countries', 'city'));
    }

    public function store(CityStoreAndUpdateRequest $request)
    {
            City::create($request->all());
            $this->added();

            return redirect()->route('city.index');
    }

    public function edit($id)
    {

        $city = City::findOrFail($id);
        $countries = Country::all();

        return view('admin.city.edit', compact('city', 'countries'));

    }

    public function update(CityStoreAndUpdateRequest $request, $id)
    {
        City::findOrFail($id)
            ->update($request->all());
        $this->edited();

        return redirect()->route('city.index');

    }

    public function destroy($id)
    {

        City::destroy($id);

        $this->deleted();

        return redirect()->route('city.index');
    }
}
