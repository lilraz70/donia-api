<?php

namespace App\Http\Requests;

use App\Models\TripFrequency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTripFrequencyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('trip_frequency_edit');
    }

    public function rules()
    {
        return [
            'day_id' => [
                'required',
                'integer',
            ],
            'trip_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
