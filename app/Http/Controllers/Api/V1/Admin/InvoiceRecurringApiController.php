<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRecurringRequest;
use App\Http\Requests\UpdateInvoiceRecurringRequest;
use App\Http\Resources\Admin\InvoiceRecurringResource;
use App\Models\InvoiceRecurring;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceRecurringApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('invoice_recurring_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoiceRecurringResource(InvoiceRecurring::with(['property', 'unit'])->get());
    }

    public function store(StoreInvoiceRecurringRequest $request)
    {
        $invoiceRecurring = InvoiceRecurring::create($request->all());

        return (new InvoiceRecurringResource($invoiceRecurring))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(InvoiceRecurring $invoiceRecurring)
    {
        abort_if(Gate::denies('invoice_recurring_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InvoiceRecurringResource($invoiceRecurring->load(['property', 'unit']));
    }

    public function update(UpdateInvoiceRecurringRequest $request, InvoiceRecurring $invoiceRecurring)
    {
        $invoiceRecurring->update($request->all());

        return (new InvoiceRecurringResource($invoiceRecurring))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(InvoiceRecurring $invoiceRecurring)
    {
        abort_if(Gate::denies('invoice_recurring_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceRecurring->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
