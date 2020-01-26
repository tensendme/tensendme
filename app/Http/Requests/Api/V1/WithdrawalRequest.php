<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\ApiBaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawalRequest extends ApiBaseRequest
{
    public function injectedRules()
    {
        return [
            'amount' => ['required', 'numeric'],
            'comment' => ['string']
        ];
    }

}
