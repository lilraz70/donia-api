<?php

namespace App\Http\Requests;

use App\Models\Servicesinclu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServicesincluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('servicesinclu_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:servicesinclus,intitule,' . request()->route('servicesinclu')->id,
            ],
        ];
    }
}
