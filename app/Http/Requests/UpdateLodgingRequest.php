<?php

namespace App\Http\Requests;

use App\Models\Lodging;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLodgingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lodging_edit');
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
                'unique:lodgings,libelle,' . request()->route('lodging')->id,
            ],
            'description' => [
                'string',
                'nullable',
            ],
        ];
    }
}
