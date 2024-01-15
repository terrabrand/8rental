<?php

namespace App\Http\Requests;

use App\Models\InvoiceRecurring;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyInvoiceRecurringRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('invoice_recurring_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:invoice_recurrings,id',
        ];
    }
}
