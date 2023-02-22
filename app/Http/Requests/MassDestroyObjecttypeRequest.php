<?php

namespace App\Http\Requests;

use App\Models\Objecttype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyObjecttypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('objecttype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:objecttypes,id',
        ];
    }
}
