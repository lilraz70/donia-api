<?php

namespace App\Http\Requests;

use App\Models\AcceptCgu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAcceptCguRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('accept_cgu_create');
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
