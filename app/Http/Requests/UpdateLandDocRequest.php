<?php

namespace App\Http\Requests;

use App\Models\LandDoc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLandDocRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('land_doc_edit');
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
