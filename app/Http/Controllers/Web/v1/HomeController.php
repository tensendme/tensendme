<?php

namespace App\Http\Controllers\Web\v1;

use App\Http\Controllers\WebBaseController;

class HomeController extends WebBaseController
{


    public function index()
    {
        return view('admin.home');
    }

    public function welcome()
    {
        return view('welcome');
    }

}
