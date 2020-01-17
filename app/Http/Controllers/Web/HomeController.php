<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\WebBaseController;
use Illuminate\Http\Request;

class HomeController extends WebBaseController
{

    public function index(Request $request)
    {
        return view('welcome');
    }

}
