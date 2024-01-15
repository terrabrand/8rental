<?php

namespace App\Http\Requests;

use App\Models\Unit;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUnitRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('unit_create');
    }

    public function rules()
    {
        return [
            'unit_name' => [
                'string',
                'required',
            ],
            'unit_property_id' => [
                'required',
                'integer',
            ],
            'rent_price' => [
                'required',
            ],
            'unit_size' => [
                'string',
                'nullable',
            ],
            'number_of_bedrooms' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'number_of_kitchens' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'number_of_bathrooms' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'unit_images' => [
                'array',
            ],
        ];
    }
}
