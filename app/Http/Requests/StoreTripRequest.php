<?php

namespace App\Http\Requests;

use App\Models\Trip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTripRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trip_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:trips',
            ],
            'lieu_depart' => [
                'string',
                'required',
                'unique:trips',
            ],
            'heure_depart' => [
                'string',
                'required',
            ],
            'lieu_arrive' => [
                'string',
                'required',
            ],
            'heure_arrive' => [
                'string',
                'nullable',
            ],
            'cout' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'typeoftrip_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
