<?php

namespace App\Http\Requests;

use App\Models\MotricityType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMotricityTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('motricity_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:motricity_types,id',
        ];
    }
}
