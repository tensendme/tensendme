<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 31.03.2020
 * Time: 14:10
 */

namespace App\Http\Controllers\Web\v1\Admin;


use App\Http\Controllers\WebBaseController;
use App\Http\Requests\Web\V1\NotificationControllerRequests\StartMassNotificationWebRequest;
use App\Services\v1\PushService;

class NotificationController extends WebBaseController
{
    protected $pushService;

    /**
     * NotificationController constructor.
     * @param $notificationService
     */
    public function __construct(PushService $notificationService)
    {
        $this->pushService = $notificationService;
    }


    public function index()
    {
        return view('admin.pushes.index');
    }

    public function start(StartMassNotificationWebRequest $request)
    {
        $this->pushService->startMassPush($request->type, $request->title, $request->description);
        $this->successOperation();
        return redirect()->back();
    }
}