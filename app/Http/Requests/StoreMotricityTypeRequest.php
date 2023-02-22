<?php

namespace App\Http\Requests;

use App\Models\MotricityType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMotricityTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('motricity_type_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:motricity_types',
            ],
        ];
    }
}
