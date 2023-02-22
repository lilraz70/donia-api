<?php

namespace App\Http\Requests;

use App\Models\Signaler;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSignalerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('signaler_create');
    }

    public function rules()
    {
        return [
            'experience_utilisateur' => [
                'string',
                'required',
            ],
            'comment' => [
                'string',
                'required',
            ],
            'objet' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'objecttype_id' => [
                'required',
                'integer',
            ],
            'reason_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
