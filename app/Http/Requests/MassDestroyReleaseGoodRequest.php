<?php

namespace App\Http\Requests;

use App\Models\ReleaseGood;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyReleaseGoodRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('release_good_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:release_goods,id',
        ];
    }
}
