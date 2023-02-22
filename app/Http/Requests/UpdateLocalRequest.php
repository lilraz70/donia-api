<?php

namespace App\Http\Requests;

use App\Models\Local;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLocalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('local_edit');
    }

    public function rules()
    {
        return [
            'nb_chambre' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'localisation' => [
                'required',
            ],
            'geolocalisation' => [
                'string',
                'nullable',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'propertytype_id' => [
                'required',
                'integer',
            ],
            'typeoffer_id' => [
                'required',
                'integer',
            ],
            'setcountry_id' => [
                'required',
                'integer',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'quartier_id' => [
                'required',
                'integer',
            ],
            'prix_vente' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'prix_location' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'libelle' => [
                'string',
                'required',
                'unique:locals,libelle,' . request()->route('local')->id,
            ],
        ];
    }
}
