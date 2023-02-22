<?php

namespace App\Http\Requests;

use App\Models\ParameterUserType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyParameterUserTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('parameter_user_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:parameter_user_types,id',
        ];
    }
}
