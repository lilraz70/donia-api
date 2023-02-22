<?php

namespace App\Http\Requests;

use App\Models\Objecttype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateObjecttypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('objecttype_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:objecttypes,intitule,' . request()->route('objecttype')->id,
            ],
        ];
    }
}
