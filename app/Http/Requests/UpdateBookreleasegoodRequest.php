<?php

namespace App\Http\Requests;

use App\Models\Bookreleasegood;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookreleasegoodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bookreleasegood_edit');
    }

    public function rules()
    {
        return [
            'releasegood_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
