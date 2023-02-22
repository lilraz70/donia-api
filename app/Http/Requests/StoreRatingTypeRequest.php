<?php

namespace App\Http\Requests;

use App\Models\RatingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRatingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rating_type_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:rating_types',
            ],
        ];
    }
}
