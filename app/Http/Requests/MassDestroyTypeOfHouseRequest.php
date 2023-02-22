<?php

namespace App\Http\Requests;

use App\Models\TypeOfHouse;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTypeOfHouseRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_of_house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:type_of_houses,id',
        ];
    }
}
