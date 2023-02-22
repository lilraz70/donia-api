<?php

namespace App\Http\Requests;

use App\Models\ColorType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyColorTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('color_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:color_types,id',
        ];
    }
}
