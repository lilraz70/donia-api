<?php

namespace App\Http\Requests;

use App\Models\Bookreleasegood;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookreleasegoodRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('bookreleasegood_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:bookreleasegoods,id',
        ];
    }
}
