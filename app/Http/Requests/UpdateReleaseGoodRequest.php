<?php

namespace App\Http\Requests;

use App\Models\ReleaseGood;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

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
                'nullable',
//                 'date_format:' . config('panel.date_format'),
            ],
            'conditions_bailleur' => [
                'nullable',
            ],
            'nb_chambre' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'localisation' => [
                'nullable',
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
                'nullable',
            ],
            'accord_bailleur' => [
                'string',
                'nullable',
            ],
            'propertytype_id' => [
                'nullable',
                'integer',
            ],
            'setcountry_id' => [
                'nullable',
                'integer',
            ],
            'city_id' => [
                'nullable',
                'integer',
            ],
            'quartier_id' => [
                'nullable',
                'integer',
            ],
            /* 'user_id' => [
                'nullable',
                'integer',
            ], */
            'emergencylevel_id' => [
                'nullable',
                'integer',
            ],
            'libelle' => [
                'string',
                'nullable',
            ],
            'commentaires' => [
                'string',
                'nullable',
            ],
            'cout' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'loyer_augmentera' => [
                'nullable',
            ], 
            'delete_image_id' => [
                'nullable',
                'array'
            ],
        ];
    }
}
