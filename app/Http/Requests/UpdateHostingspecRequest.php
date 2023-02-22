<?php

namespace App\Http\Requests;

use App\Models\Hostingspec;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHostingspecRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hostingspec_edit');
    }

    public function rules()
    {
        return [
            'lodging_id' => [
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
