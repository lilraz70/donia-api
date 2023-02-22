<?php

namespace App\Http\Requests;

use App\Models\TypeAdmDoc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTypeAdmDocRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_adm_doc_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_adm_docs,intitule,' . request()->route('type_adm_doc')->id,
            ],
        ];
    }
}
