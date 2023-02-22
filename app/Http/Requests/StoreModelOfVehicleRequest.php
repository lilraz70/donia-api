<?php

namespace App\Http\Requests;

use App\Models\ModelOfVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreModelOfVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('model_of_vehicle_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:model_of_vehicles',
            ],
            'brand_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
