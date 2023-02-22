<?php

namespace App\Http\Requests;

use App\Models\SetCountry;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySetCountryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('set_country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:set_countries,id',
        ];
    }
}
