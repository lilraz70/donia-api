<?php

namespace App\Http\Requests;

use App\Models\TypeOffer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTypeOfferRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_offer_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:type_offers',
            ],
        ];
    }
}
