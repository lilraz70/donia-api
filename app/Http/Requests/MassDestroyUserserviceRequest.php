<?php

namespace App\Http\Requests;

use App\Models\Userservice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyUserserviceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('userservice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:userservices,id',
        ];
    }
}
