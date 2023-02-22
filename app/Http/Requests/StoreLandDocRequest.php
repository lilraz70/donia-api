<?php

namespace App\Http\Requests;

use App\Models\LandDoc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLandDocRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('land_doc_create');
    }

    public function rules()
    {
        return [
            'land_id' => [
                'required',
                'integer',
            ],
            'typeadmdoc_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
