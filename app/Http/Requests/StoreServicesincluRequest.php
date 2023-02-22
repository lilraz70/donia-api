<?php

namespace App\Http\Requests;

use App\Models\Servicesinclu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServicesincluRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('servicesinclu_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:servicesinclus',
            ],
        ];
    }
}
