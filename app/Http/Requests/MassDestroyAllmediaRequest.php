<?php

namespace App\Http\Requests;

use App\Models\Allmedia;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAllmediaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('allmedia_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:allmedias,id',
        ];
    }
}
