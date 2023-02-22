<?php

namespace App\Http\Requests;

use App\Models\AcceptCgu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAcceptCguRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('accept_cgu_edit');
    }

    public function rules()
    {
        return [
            'deviceinfo' => [
                'string',
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
