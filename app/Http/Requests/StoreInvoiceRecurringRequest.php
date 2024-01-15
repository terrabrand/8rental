<?php

namespace App\Http\Requests;

use App\Models\InvoiceRecurring;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInvoiceRecurringRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('invoice_recurring_create');
    }

    public function rules()
    {
        return [
            'property_id' => [
                'required',
                'integer',
            ],
            'unit_id' => [
                'required',
                'integer',
            ],
            'amount' => [
                'required',
            ],
            'billing_cycle' => [
                'required',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
