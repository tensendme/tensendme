<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 14.03.2020
 * Time: 09:07
 */

namespace App\Http\Requests\Web\V1\MarketingMaterialControllerRequests;


use App\Http\Requests\WebBaseRequest;

class MarketingMaterialStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'url' => ['required', 'string'],
            'image' => ['image'],
        ];
    }

}