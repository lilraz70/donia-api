<?php

namespace App\Http\Requests;

use App\Models\SellRentCar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySellRentCarRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sell_rent_car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sell_rent_cars,id',
        ];
    }
}
