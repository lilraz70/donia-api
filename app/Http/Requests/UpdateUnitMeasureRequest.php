<?php

namespace App\Http\Requests;

use App\Models\UnitMeasure;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUnitMeasureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_measure_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:unit_measures,intitule,' . request()->route('unit_measure')->id,
            ],
        ];
    }
}
