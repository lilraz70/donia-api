<?php

namespace App\Http\Requests;

use App\Models\Bookreleasegood;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBookreleasegoodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bookreleasegood_create');
    }

    public function rules()
    {
        return [
            'releasegood_id' => [
                'required',

            ],
            'user_id' => [
                'required',
                
            ],
        ];
    }
}
