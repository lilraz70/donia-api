<?php

namespace App\Http\Requests;

use App\Models\EnergyType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEnergyTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('energy_type_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:energy_types,intitule,' . request()->route('energy_type')->id,
            ],
        ];
    }
}
