<?php

namespace App\Http\Requests;

use App\Models\TypeOfMedium;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTypeOfMediumRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_of_medium_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_of_media,intitule,' . request()->route('type_of_medium')->id,
            ],
        ];
    }
}
