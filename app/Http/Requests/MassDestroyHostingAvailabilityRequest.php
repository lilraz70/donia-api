<?php

namespace App\Http\Requests;

use App\Models\HostingAvailability;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHostingAvailabilityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hosting_availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hosting_availabilities,id',
        ];
    }
}
