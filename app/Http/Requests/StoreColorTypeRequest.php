<?php

namespace App\Http\Requests;

use App\Models\ColorType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreColorTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('color_type_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:color_types',
            ],
        ];
    }
}
