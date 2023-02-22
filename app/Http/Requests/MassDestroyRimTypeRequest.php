<?php

namespace App\Http\Requests;

use App\Models\RimType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRimTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rim_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rim_types,id',
        ];
    }
}
