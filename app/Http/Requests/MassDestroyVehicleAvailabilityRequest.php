<?php

namespace App\Http\Requests;

use App\Models\VehicleAvailability;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVehicleAvailabilityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('vehicle_availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:vehicle_availabilities,id',
        ];
    }
}
