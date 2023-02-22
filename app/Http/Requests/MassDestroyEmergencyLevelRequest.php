<?php

namespace App\Http\Requests;

use App\Models\EmergencyLevel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyEmergencyLevelRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('emergency_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:emergency_levels,id',
        ];
    }
}
