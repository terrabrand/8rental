<?php

namespace App\Http\Requests;

use App\Models\FeaturesSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFeaturesSectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('features_section_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'title_2' => [
                'string',
                'nullable',
            ],
            'main_description' => [
                'string',
                'nullable',
            ],
            'slide_show' => [
                'array',
            ],
            'button_text' => [
                'string',
                'nullable',
            ],
            'button_link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
