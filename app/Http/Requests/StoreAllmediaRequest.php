<?php

namespace App\Http\Requests;

use App\Models\Allmedia;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAllmediaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('allmedia_create');
    }

    public function rules()
    {
        return [
            'lien_ressources' => [
                'required',
            ],
            'etiquettes' => [
                'string',
                'required',
            ],
            'objecttype_id' => [
                'required',
                'integer',
            ],
            'typeofmedia_id' => [
                'required',
                'integer',
            ],
            'objet' => [
                'string',
                'required',
            ],
        ];
    }
}
