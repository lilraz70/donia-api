<?php

namespace App\Http\Requests;

use App\Models\Quartier;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQuartierRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('quartier_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
            ],
            'set_countries_id' => [
                'required',
                'integer',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
