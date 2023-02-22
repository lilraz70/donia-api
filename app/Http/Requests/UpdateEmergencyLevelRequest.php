<?php

namespace App\Http\Requests;

use App\Models\EmergencyLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmergencyLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('emergency_level_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:emergency_levels,intitule,' . request()->route('emergency_level')->id,
            ],
        ];
    }
}
