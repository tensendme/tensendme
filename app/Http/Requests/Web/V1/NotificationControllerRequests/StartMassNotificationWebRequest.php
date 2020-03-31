<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 31.03.2020
 * Time: 14:19
 */

namespace App\Http\Requests\Web\V1\NotificationControllerRequests;


use App\Http\Requests\WebBaseRequest;
use App\Utils\StaticConstants;

class StartMassNotificationWebRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'type' => ['numeric', 'required', "in:" . StaticConstants::ALL_TYPE . "," . StaticConstants::NOT_PAID_TYPE],
            'title' => ['string', 'required'],
            'description' => ['string', 'required'],
        ];
    }

}