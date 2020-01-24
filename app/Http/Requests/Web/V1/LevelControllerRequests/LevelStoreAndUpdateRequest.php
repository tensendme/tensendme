<?php


namespace App\Http\Requests\Web\V1\LevelControllerRequests;
use App\Http\Requests\WebBaseRequest;


class LevelStoreAndUpdateRequest extends WebBaseRequest
{
    public function injectedRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'start_count' => ['required','numeric'],
            'end_count' => ['required','numeric'],
            'discount_percentage' => ['required','numeric'],
        ];
    }
}
