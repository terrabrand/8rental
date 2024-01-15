<?php

namespace App\Http\Requests;

use App\Models\FeaturesSection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFeaturesSectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('features_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:features_sections,id',
        ];
    }
}
