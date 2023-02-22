<?php

namespace App\Http\Requests;

use App\Models\TypeOfTrip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTypeOfTripRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_of_trip_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_of_trips',
            ],
        ];
    }
}
