<?php

namespace App\Http\Requests;

use App\Models\NeedVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyNeedVehicleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('need_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:need_vehicles,id',
        ];
    }
}
