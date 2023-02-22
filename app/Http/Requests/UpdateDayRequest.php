<?php

namespace App\Http\Requests;

use App\Models\Day;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('day_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:days,intitule,' . request()->route('day')->id,
            ],
        ];
    }
}
