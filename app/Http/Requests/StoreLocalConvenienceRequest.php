<?php

namespace App\Http\Requests;

use App\Models\LocalConvenience;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLocalConvenienceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('local_convenience_create');
    }

    public function rules()
    {
        return [
            'local_id' => [
                'required',
                'integer',
            ],
            'conveniencetype_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
