<?php

namespace App\Http\Requests;

use App\Models\Carpool;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarpoolRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('carpool_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:carpools,id',
        ];
    }
}
