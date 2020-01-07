<?php

namespace App\Http\Requests;

use App\Exceptions\WebServiceException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class WebBaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public abstract function injectedRules(): array;

    public function rules()
    {
        return $this->injectedRules();
    }

    protected function failedValidation(Validator $validator)
    {
        request()
            ->session()
            ->flash('error', trans('admin.error'));
        throw new WebServiceException($validator, request()->all());
    }


}
