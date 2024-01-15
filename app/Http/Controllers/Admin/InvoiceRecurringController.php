<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceRecurringRequest;
use App\Http\Requests\StoreInvoiceRecurringRequest;
use App\Http\Requests\UpdateInvoiceRecurringRequest;
use App\Models\InvoiceRecurring;
use App\Models\Property;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceRecurringController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('invoice_recurring_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceRecurrings = InvoiceRecurring::with(['property', 'unit'])->get();

        return view('admin.invoiceRecurrings.index', compact('invoiceRecurrings'));
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_recurring_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::pluck('property_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('unit_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.invoiceRecurrings.create', compact('properties', 'units'));
    }

    public function store(StoreInvoiceRecurringRequest $request)
    {
        $invoiceRecurring = InvoiceRecurring::create($request->all());

        return redirect()->route('admin.invoice-recurrings.index');
    }

    public function edit(InvoiceRecurring $invoiceRecurring)
    {
        abort_if(Gate::denies('invoice_recurring_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $properties = Property::pluck('property_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('unit_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoiceRecurring->load('property', 'unit');

        return view('admin.invoiceRecurrings.edit', compact('invoiceRecurring', 'properties', 'units'));
    }

    public function update(UpdateInvoiceRecurringRequest $request, InvoiceRecurring $invoiceRecurring)
    {
        $invoiceRecurring->update($request->all());

        return redirect()->route('admin.invoice-recurrings.index');
    }

    public function show(InvoiceRecurring $invoiceRecurring)
    {
        abort_if(Gate::denies('invoice_recurring_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceRecurring->load('property', 'unit');

        return view('admin.invoiceRecurrings.show', compact('invoiceRecurring'));
    }

    public function destroy(InvoiceRecurring $invoiceRecurring)
    {
        abort_if(Gate::denies('invoice_recurring_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoiceRecurring->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceRecurringRequest $request)
    {
        $invoiceRecurrings = InvoiceRecurring::find(request('ids'));

        foreach ($invoiceRecurrings as $invoiceRecurring) {
            $invoiceRecurring->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
