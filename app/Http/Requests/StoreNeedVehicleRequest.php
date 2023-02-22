<?php

namespace App\Http\Requests;

use App\Models\NeedVehicle;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNeedVehicleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('need_vehicle_create');
    }

    public function rules()
    {
        return [
            'finition' => [
                'string',
                'required',
            ],
            'nb_place' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'annee_fabrication' => [
                'string',
                'required',
            ],
            'conso_au_100_km' => [
                'string',
                'required',
            ],
            'nb_chevaux' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'nb_cylindre' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'accessoires' => [
                'string',
                'nullable',
            ],
            'kilometrage' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'options' => [
                'string',
                'required',
            ],
            'pannes_signalees' => [
                'string',
                'required',
            ],
            'immatriculation' => [
                'string',
                'required',
            ],
            'brand_id' => [
                'required',
                'integer',
            ],
            'modelofvehicle_id' => [
                'required',
                'integer',
            ],
            'colortype_id' => [
                'required',
                'integer',
            ],
            'energytype_id' => [
                'required',
                'integer',
            ],
            'gearbox_id' => [
                'required',
                'integer',
            ],
            'vehicletype_id' => [
                'required',
                'integer',
            ],
            'typeofutility_id' => [
                'required',
                'integer',
            ],
            'motricitytype_id' => [
                'required',
                'integer',
            ],
            'typeofwheel_id' => [
                'required',
                'integer',
            ],
            'rimtype_id' => [
                'required',
                'integer',
            ],
            'listofcountry_id' => [
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
            'typeoffer_id' => [
                'required',
                'integer',
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
            'description' => [
                'string',
                'nullable',
            ],
            'libelle' => [
                'string',
                'required',
                'unique:need_vehicles',
            ],
            'emergencylevel_id' => [
                'required',
                'integer',
            ],
            'date_limite_demande' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
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
