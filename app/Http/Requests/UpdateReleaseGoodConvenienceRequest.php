<?php

namespace App\Http\Requests;

use App\Models\ReleaseGoodConvenience;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateReleaseGoodConvenienceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('release_good_convenience_edit');
    }

    public function rules()
    {
        return [
            'releasegood_id' => [
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
