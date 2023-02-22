<?php

namespace App\Http\Requests;

use App\Models\GearBox;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGearBoxRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('gear_box_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:gear_boxes,id',
        ];
    }
}
