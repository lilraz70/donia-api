<?php

namespace App\Http\Requests;

use App\Models\LocalConvenience;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyLocalConvenienceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('local_convenience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:local_conveniences,id',
        ];
    }
}
