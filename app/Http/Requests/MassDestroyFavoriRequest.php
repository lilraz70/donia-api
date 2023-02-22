<?php

namespace App\Http\Requests;

use App\Models\Favori;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFavoriRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('favori_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:favoris,id',
        ];
    }
}
