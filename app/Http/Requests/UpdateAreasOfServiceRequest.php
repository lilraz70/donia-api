<?php

namespace App\Http\Requests;

use App\Models\AreasOfService;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAreasOfServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('areas_of_service_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:areas_of_services,intitule,' . request()->route('areas_of_service')->id,
            ],
        ];
    }
}
