<?php

namespace App\Http\Requests;

use App\Models\HeroSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHeroSectionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hero_section_edit');
    }

    public function rules()
    {
        return [
            'main_title' => [
                'string',
                'required',
            ],
            'main_title_description' => [
                'string',
                'required',
            ],
            'main_button_title' => [
                'string',
                'required',
            ],
            'main_button_link' => [
                'string',
                'required',
            ],
            'main_image' => [
                'required',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
