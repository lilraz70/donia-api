<?php

namespace App\Http\Requests;

use App\Models\Favori;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFavoriRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('favori_create');
    }

    public function rules()
    {
        return [
            'object' => [
                'string',
                'required',
            ],
            'objecttype_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
