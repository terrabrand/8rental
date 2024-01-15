<?php

namespace App\Http\Requests;

use App\Models\Expense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expense_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'landlords.*' => [
                'integer',
            ],
            'landlords' => [
                'array',
            ],
            'properties.*' => [
                'integer',
            ],
            'properties' => [
                'array',
            ],
            'units.*' => [
                'integer',
            ],
            'units' => [
                'array',
            ],
            'tenants.*' => [
                'integer',
            ],
            'tenants' => [
                'array',
            ],
            'expense_types.*' => [
                'integer',
            ],
            'expense_types' => [
                'required',
                'array',
            ],
        ];
    }
}
