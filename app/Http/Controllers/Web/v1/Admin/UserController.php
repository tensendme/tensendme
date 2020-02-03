<?php

namespace App\Http\Controllers\Web\V1\Admin;

use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\CourseControllerRequests\CourseStoreAndUpdateRequest;
use App\Models\Profiles\User;
use App\Services\v1\FileService;
use App\Utils\StaticConstants;

class UserController extends ApiBaseController
{

    protected $fileService;

    /**
     * CourseController constructor.
     * @param $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }


    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }


}
