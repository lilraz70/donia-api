<?php

namespace App\Http\Requests;

use App\Models\ListOfCountry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateListOfCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('list_of_country_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:list_of_countries,intitule,' . request()->route('list_of_country')->id,
            ],
            'code' => [
                'string',
                'required',
                'unique:list_of_countries,code,' . request()->route('list_of_country')->id,
            ],
            'prefix' => [
                'string',
                'required',
                'unique:list_of_countries,prefix,' . request()->route('list_of_country')->id,
            ],
        ];
    }
}
