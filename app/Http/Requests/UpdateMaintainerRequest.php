<?php

namespace App\Http\Requests;

use App\Models\Maintainer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMaintainerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('maintainer_edit');
    }

    public function rules()
    {
        return [
            'phone_number' => [
                'string',
                'nullable',
            ],
            'units_assigneds.*' => [
                'integer',
            ],
            'units_assigneds' => [
                'array',
            ],
        ];
    }
}
