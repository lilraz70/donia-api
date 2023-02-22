<?php

namespace App\Http\Requests;

use App\Models\ReleaseGood;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReleaseGoodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('release_good_edit');
    }

    public function rules()
    {
        return [
            'date_sorti_prevu' => [
                'required',
//                 'date_format:' . config('panel.date_format'),
            ],
            'conditions_bailleur' => [
                'required',
            ],
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
            'date_limite' => [
               // 'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'contact_bailleur' => [
                'string',
                'required',
            ],
            'accord_bailleur' => [
                'string',
                'nullable',
            ],
            'propertytype_id' => [
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
            /* 'user_id' => [
                'required',
                'integer',
            ], */
            'emergencylevel_id' => [
                'required',
                'integer',
            ],
            'libelle' => [
                'string',
                'nullable',
            ],
            'cout' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'loyer_augmentera' => [
                'required',
            ],
        ];
    }
}
