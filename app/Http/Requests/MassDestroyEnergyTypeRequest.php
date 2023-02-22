<?php

namespace App\Http\Requests;

use App\Models\EnergyType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEnergyTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('energy_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:energy_types,id',
        ];
    }
}
