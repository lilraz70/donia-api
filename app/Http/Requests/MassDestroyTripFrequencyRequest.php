<?php

namespace App\Http\Requests;

use App\Models\TripFrequency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTripFrequencyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('trip_frequency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:trip_frequencies,id',
        ];
    }
}
