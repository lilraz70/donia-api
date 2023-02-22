<?php

namespace App\Http\Requests;

use App\Models\Configuration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateConfigurationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuration_edit');
    }

    public function rules()
    {
        return [
            'cle' => [
                'string',
                'required',
                'unique:configurations,cle,' . request()->route('configuration')->id,
            ],
            'valeur' => [
                'string',
                'nullable',
            ],
        ];
    }
}
