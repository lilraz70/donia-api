<?php

namespace App\Http\Requests;

use App\Models\RimType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRimTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rim_type_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:rim_types,intitule,' . request()->route('rim_type')->id,
            ],
        ];
    }
}
