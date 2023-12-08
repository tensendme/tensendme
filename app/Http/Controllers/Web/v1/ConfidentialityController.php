<?php

namespace App\Http\Controllers\Web\v1;

use App\Http\Controllers\WebBaseController;

class ConfidentialityController extends WebBaseController
{
    public function index() {
        return view('confidentiality');
    }
}
