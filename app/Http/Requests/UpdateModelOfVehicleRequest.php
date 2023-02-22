<?php

namespace App\Http\Requests;

use App\Models\ModelOfVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateModelOfVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('model_of_vehicle_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:model_of_vehicles,intitule,' . request()->route('model_of_vehicle')->id,
            ],
            'brand_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
