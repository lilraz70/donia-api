<?php

namespace App\Http\Requests;

use App\Models\AreasOfService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAreasOfServiceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('areas_of_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:areas_of_services,id',
        ];
    }
}
