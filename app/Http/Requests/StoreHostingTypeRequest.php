<?php

namespace App\Http\Requests;

use App\Models\HostingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHostingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hosting_type_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:hosting_types',
            ],
        ];
    }
}
