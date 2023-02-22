<?php

namespace App\Http\Requests;

use App\Models\TypeAdmDoc;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTypeAdmDocRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_adm_doc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:type_adm_docs,id',
        ];
    }
}
