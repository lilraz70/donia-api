<?php

namespace App\Http\Requests;

use App\Models\LandCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLandCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('land_category_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:land_categories',
            ],
        ];
    }
}
