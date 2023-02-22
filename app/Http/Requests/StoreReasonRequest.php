<?php

namespace App\Http\Requests;

use App\Models\Reason;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReasonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reason_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:reasons',
            ],
        ];
    }
}
