<?php

namespace App\Http\Requests;

use App\Models\Userparam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserparamRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('userparam_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'parameterusertype_id' => [
                'required',
                'integer',
            ],
            'param_value' => [
                'string',
                'required',
            ],
        ];
    }
}
