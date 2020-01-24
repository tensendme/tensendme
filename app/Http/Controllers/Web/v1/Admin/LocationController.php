<?php

namespace App\Http\Controllers\Web\v1\Admin;


use App\Http\Controllers\WebBaseController;
use App\Models\News\Location;
use App\Http\Requests\Web\V1\LocationControllerRequests\LocationStoreAndUpdateRequest;

use Illuminate\Http\Request;


class LocationController extends WebBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.location.index',compact('locations'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = new Location();

        return view('admin.location.create',compact('location'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationStoreAndUpdateRequest $request)
    {

            Location::create($request->all());
            $this->added();
            return redirect()->route('location.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location= Location::findOrFail($id);

        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationStoreAndUpdateRequest $request, $id)
    {
        Location::findOrFail($id)
            ->update($request->all());
        $this->edited();
        return redirect()->route('location.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::destroy($id);

        $this->deleted();

        return redirect()->route('location.index');
    }
}
