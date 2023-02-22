<?php

namespace App\Http\Requests;

use App\Models\TypeAdmDoc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTypeAdmDocRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_adm_doc_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_adm_docs',
            ],
        ];
    }
}
