<?php

namespace App\Http\Requests;

use App\Models\Carpool;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCarpoolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('carpool_create');
    }

    public function rules()
    {
        return [
            'user_client_id' => [
                'required',
                'integer',
            ],
            'user_fournisseur_id' => [
                'required',
                'integer',
            ],
            'paiement' => [
                'string',
                'required',
            ],
            'preuve_paiement' => [
                'string',
                'nullable',
            ],
            'mention_arrive' => [
                'string',
                'nullable',
            ],
            'mention_arv_heure' => [
                'string',
                'nullable',
            ],
            'trip_id' => [
                'required',
                'integer',
            ],
            'carpoolingvehicle_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
