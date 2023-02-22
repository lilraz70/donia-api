<?php

namespace App\Http\Requests;

use App\Models\ListStatut;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreListStatutRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('list_statut_create');
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
