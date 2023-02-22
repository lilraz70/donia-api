<?php

namespace App\Http\Requests;

use App\Models\ConvenienceType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyConvenienceTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('convenience_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:convenience_types,id',
        ];
    }
}
