<?php

namespace App\Http\Requests;

use App\Models\TypeOfHouse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTypeOfHouseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_of_house_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_of_houses',
            ],
        ];
    }
}
