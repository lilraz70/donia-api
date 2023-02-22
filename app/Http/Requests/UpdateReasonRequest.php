<?php

namespace App\Http\Requests;

use App\Models\Reason;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReasonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reason_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:reasons,intitule,' . request()->route('reason')->id,
            ],
        ];
    }
}
