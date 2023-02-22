<?php

namespace App\Http\Requests;

use App\Models\ConvenienceType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateConvenienceTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('convenience_type_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:convenience_types,intitule,' . request()->route('convenience_type')->id,
            ],
        ];
    }
}
