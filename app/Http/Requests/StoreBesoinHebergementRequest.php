<?php

namespace App\Http\Requests;

use App\Models\BesoinHebergement;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBesoinHebergementRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('besoin_hebergement_create');
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
            'prix_journalier' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'prix_mensuel' => [
                'nullable',
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
            'hostingtype_id' => [
                'required',
                'integer',
            ],
            'typeofhouse_id' => [
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
            'user_id' => [
                'required',
                'integer',
            ],
            'liststatut_id' => [
                'required',
                'integer',
            ],
            'libelle' => [
                'string',
                'required',
                'unique:besoin_hebergements',
            ],
            'description' => [
                'string',
                'nullable',
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
            'conveniences' => [
                'string',
                'nullable',
            ],
            'servicesinclus' => [
                'string',
                'nullable',
            ],
        ];
    }
}
