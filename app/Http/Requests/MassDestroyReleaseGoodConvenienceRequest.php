<?php

namespace App\Http\Requests;

use App\Models\ReleaseGoodConvenience;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyReleaseGoodConvenienceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('release_good_convenience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:release_good_conveniences,id',
        ];
    }
}
