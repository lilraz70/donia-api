<?php

namespace App\Http\Requests;

use App\Models\ListStatut;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyListStatutRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('list_statut_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:list_statuts,id',
        ];
    }
}
