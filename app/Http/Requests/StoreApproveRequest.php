<?php

namespace App\Http\Requests;

use App\Models\Approve;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreApproveRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('approve_create');
    }

    public function rules()
    {
        return [
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
            'resultat' => [
                'string',
                'required',
            ],
        ];
    }
}
