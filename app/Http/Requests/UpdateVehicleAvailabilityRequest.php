<?php

namespace App\Http\Requests;

use App\Models\VehicleAvailability;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVehicleAvailabilityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('vehicle_availability_edit');
    }

    public function rules()
    {
        return [
            'jour_debut' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'heure_debut' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'jour_fin' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'heure_fin' => [
                'date_format:' . config('panel.time_format'),
                'nullable',
            ],
            'sellrentcar_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
