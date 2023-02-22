<?php

namespace App\Http\Requests;

use App\Models\RatingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRatingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rating_type_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:rating_types,intitule,' . request()->route('rating_type')->id,
            ],
        ];
    }
}
