<?php

namespace App\Http\Requests;

use App\Models\Trip;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTripRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trip_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:trips,intitule,' . request()->route('trip')->id,
            ],
            'lieu_depart' => [
                'string',
                'required',
                'unique:trips,lieu_depart,' . request()->route('trip')->id,
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
