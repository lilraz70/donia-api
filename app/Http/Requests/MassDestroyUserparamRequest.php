<?php

namespace App\Http\Requests;

use App\Models\Userparam;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserparamRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('userparam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:userparams,id',
        ];
    }
}
