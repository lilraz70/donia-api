<?php

namespace App\Http\Requests;

use App\Models\ReleaseGood;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReleaseGoodRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('release_good_create');
    }

    public function rules()
    {
        return [
            'date_sorti_prevu' => [
                'required',

            ],
            'conditions_bailleur' => [
                'required',
            ],
            'nb_chambre' => [
                'required',

            ],
            'localisation' => [
                'required',
            ],
            'geolocalisation' => [
                'string',

            ],
            'date_limite' => [
                'required',
            ],
            'contact_bailleur' => [
                 'required',
            ],
            'accord_bailleur' => [
                  'nullable',
            ],
            'verif_accord_bailleur' => [
                  'nullable',
            ],
            'propertytype_id' => [
                'required',

            ],
            'setcountry_id' => [
                'required',

            ],
            
        ];
    }
}
