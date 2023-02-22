<?php

namespace App\Http\Requests;

use App\Models\SetCountry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSetCountryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('set_country_edit');
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
                'unique:set_countries,code,' . request()->route('set_country')->id,
            ],
            'prefix' => [
                'string',
                'required',
                'unique:set_countries,prefix,' . request()->route('set_country')->id,
            ],
            'flag' => [
                'string',
                'required',
                'unique:set_countries,flag,' . request()->route('set_country')->id,
            ],
        ];
    }
}
