<?php

namespace App\Http\Requests;

use App\Models\BesoinLocal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBesoinLocalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('besoin_local_edit');
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
            'libelle' => [
                'string',
                'required',
                'unique:besoin_locals,libelle,' . request()->route('besoin_local')->id,
            ],
            'date_limite_demande' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'budget_max_achat' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'budget_max_location' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'emergencylevel_id' => [
                'required',
                'integer',
            ],
            'satisfait' => [
                'string',
                'nullable',
            ],
            'date_satisfait' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
