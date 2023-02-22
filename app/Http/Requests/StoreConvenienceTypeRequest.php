<?php

namespace App\Http\Requests;

use App\Models\ConvenienceType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConvenienceTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('convenience_type_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:convenience_types',
            ],
        ];
    }
}
