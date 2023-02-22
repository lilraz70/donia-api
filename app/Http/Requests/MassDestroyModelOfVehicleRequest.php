<?php

namespace App\Http\Requests;

use App\Models\ModelOfVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyModelOfVehicleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('model_of_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:model_of_vehicles,id',
        ];
    }
}
