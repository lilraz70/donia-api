<?php

namespace App\Http\Requests;

use App\Models\PaymentMode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentModeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_mode_create');
    }

    public function rules()
    {
        return [
            'intitule' => [
                'string',
                'required',
                'unique:payment_modes',
            ],
        ];
    }
}
