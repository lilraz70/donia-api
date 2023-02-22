<?php

namespace App\Http\Requests;

use App\Models\NeedLand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNeedLandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('need_land_edit');
    }

    public function rules()
    {
        return [
            'superficie' => [
                'numeric',
                'required',
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
            'landcategory_id' => [
                'required',
                'integer',
            ],
            'libelle' => [
                'string',
                'required',
                'unique:need_lands,libelle,' . request()->route('need_land')->id,
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
