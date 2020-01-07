<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use Illuminate\Http\Request;
use App\Models\Profiles\Country;



class CountryController extends WebBaseController
{

    public function index()
    {
        $countries = Country::all();

        return view('admin.country.index',compact('countries'));
    }
}
