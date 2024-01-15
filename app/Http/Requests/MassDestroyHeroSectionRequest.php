<?php

namespace App\Http\Requests;

use App\Models\HeroSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHeroSectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hero_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hero_sections,id',
        ];
    }
}
