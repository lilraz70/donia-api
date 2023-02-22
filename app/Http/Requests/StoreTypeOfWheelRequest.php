<?php

namespace App\Http\Requests;

use App\Models\TypeOfWheel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTypeOfWheelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_of_wheel_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_of_wheels',
            ],
        ];
    }
}
