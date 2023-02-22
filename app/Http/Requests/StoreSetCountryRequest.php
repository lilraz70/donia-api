<?php

namespace App\Http\Requests;

use App\Models\SetCountry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSetCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('set_country_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
            ],
            'code' => [
                'string',
                'required',
                'unique:set_countries',
            ],
            'prefix' => [
                'string',
                'required',
                'unique:set_countries',
            ],
            'flag' => [
                'string',
                'required',
                'unique:set_countries',
            ],
        ];
    }
}
