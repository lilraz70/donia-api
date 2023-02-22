<?php

namespace App\Http\Requests;

use App\Models\TypeOfUtility;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTypeOfUtilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_of_utility_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_of_utilities,intitule,' . request()->route('type_of_utility')->id,
            ],
        ];
    }
}
