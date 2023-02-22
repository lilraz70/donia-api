<?php

namespace App\Http\Requests;

use App\Models\PaymentMode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPaymentModeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('payment_mode_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:payment_modes,id',
        ];
    }
}
