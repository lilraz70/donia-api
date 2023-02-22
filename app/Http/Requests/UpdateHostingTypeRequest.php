<?php

namespace App\Http\Requests;

use App\Models\HostingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHostingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hosting_type_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:hosting_types,intitule,' . request()->route('hosting_type')->id,
            ],
        ];
    }
}
