<?php

namespace App\Http\Requests;

use App\Models\BesoinHebergement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBesoinHebergementRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('besoin_hebergement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:besoin_hebergements,id',
        ];
    }
}
