<?php

namespace App\Http\Requests;

use App\Models\Objecttype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreObjecttypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('objecttype_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:objecttypes',
            ],
        ];
    }
}
