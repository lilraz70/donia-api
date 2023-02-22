<?php

namespace App\Http\Requests;

use App\Models\ParameterUserType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateParameterUserTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('parameter_user_type_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
            ],
        ];
    }
}
