<?php

namespace App\Http\Controllers\Web\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WebBaseController;
use App\Models\Histories\History;

class HistoryController extends WebBaseController
{
    public function index() {
        $histories = History::paginate(10);
        return view('admin.userActions.histories.index', compact('histories'));
    }
}
