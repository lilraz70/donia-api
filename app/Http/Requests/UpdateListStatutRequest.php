<?php

namespace App\Http\Requests;

use App\Models\ListStatut;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateListStatutRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('list_statut_edit');
    }

    public function rules()
    {
        return [
            'intitule' => [
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
