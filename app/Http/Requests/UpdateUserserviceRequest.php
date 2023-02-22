<?php

namespace App\Http\Requests;

use App\Models\Userservice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserserviceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('userservice_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'areasofservice_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
