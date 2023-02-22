<?php

namespace App\Http\Requests;

use App\Models\Rating;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRatingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rating_create');
    }

    public function rules()
    {
        return [
            'areasofservices_id' => [
                'required',
                'integer',
            ],
            'objecttype_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'ratingtype_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
