<?php

namespace App\Http\Requests;

use App\Models\ApplicationSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateApplicationSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('application_setting_edit');
    }

    public function rules()
    {
        return [
            'application_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
