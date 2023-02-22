<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comment_edit');
    }

    public function rules()
    {
        return [
            'contenu' => [
                'string',
                'required',
            ],
            'objecttype_id' => [
                'required',
                'integer',
            ],
            'areasofservice_id' => [
                'required',
                'integer',
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
        ];
    }
}
