<?php

namespace App\Http\Requests;

use App\Models\RatingType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRatingTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rating_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rating_types,id',
        ];
    }
}
