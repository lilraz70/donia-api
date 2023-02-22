<?php

namespace App\Http\Requests;

use App\Models\ListOfCountry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreListOfCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('list_of_country_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:list_of_countries',
            ],
            'code' => [
                'string',
                'required',
                'unique:list_of_countries',
            ],
            'prefix' => [
                'string',
                'required',
                'unique:list_of_countries',
            ],
        ];
    }
}
