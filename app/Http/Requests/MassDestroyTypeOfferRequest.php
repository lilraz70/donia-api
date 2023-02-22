<?php

namespace App\Http\Requests;

use App\Models\TypeOffer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTypeOfferRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('type_offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:type_offers,id',
        ];
    }
}
