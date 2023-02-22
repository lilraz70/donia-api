<?php

namespace App\Http\Requests;

use App\Models\GearBox;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGearBoxRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gear_box_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:gear_boxes',
            ],
        ];
    }
}
