<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\InvoiceType;
use App\Models\Landlord;
use App\Models\Property;
use App\Models\Section;
use App\Models\Tenant;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoicesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::with(['tenants', 'landlords', 'invoice_types', 'properties', 'sections', 'units'])->get();

        $tenants = Tenant::get();

        $landlords = Landlord::get();

        $invoice_types = InvoiceType::get();

        $properties = Property::get();

        $sections = Section::get();

        $units = Unit::get();

        return view('admin.invoices.index', compact('invoice_types', 'invoices', 'landlords', 'properties', 'sections', 'tenants', 'units'));
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenants = Tenant::pluck('first_name', 'id');

        $landlords = Landlord::pluck('name', 'id');

        $invoice_types = InvoiceType::pluck('name', 'id');

        $properties = Property::pluck('property_name', 'id');

        $sections = Section::pluck('section_name', 'id');

        $units = Unit::pluck('unit_name', 'id');

        return view('admin.invoices.create', compact('invoice_types', 'landlords', 'properties', 'sections', 'tenants', 'units'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $invoice = Invoice::create($request->all());
        $invoice->tenants()->sync($request->input('tenants', []));
        $invoice->landlords()->sync($request->input('landlords', []));
        $invoice->invoice_types()->sync($request->input('invoice_types', []));
        $invoice->properties()->sync($request->input('properties', []));
        $invoice->sections()->sync($request->input('sections', []));
        $invoice->units()->sync($request->input('units', []));

        return redirect()->route('admin.invoices.index');
    }

    public function edit(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenants = Tenant::pluck('first_name', 'id');

        $landlords = Landlord::pluck('name', 'id');

        $invoice_types = InvoiceType::pluck('name', 'id');

        $properties = Property::pluck('property_name', 'id');

        $sections = Section::pluck('section_name', 'id');

        $units = Unit::pluck('unit_name', 'id');

        $invoice->load('tenants', 'landlords', 'invoice_types', 'properties', 'sections', 'units');

        return view('admin.invoices.edit', compact('invoice', 'invoice_types', 'landlords', 'properties', 'sections', 'tenants', 'units'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());
        $invoice->tenants()->sync($request->input('tenants', []));
        $invoice->landlords()->sync($request->input('landlords', []));
        $invoice->invoice_types()->sync($request->input('invoice_types', []));
        $invoice->properties()->sync($request->input('properties', []));
        $invoice->sections()->sync($request->input('sections', []));
        $invoice->units()->sync($request->input('units', []));

        return redirect()->route('admin.invoices.index');
    }

    public function show(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->load('tenants', 'landlords', 'invoice_types', 'properties', 'sections', 'units');

        return view('admin.invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceRequest $request)
    {
        $invoices = Invoice::find(request('ids'));

        foreach ($invoices as $invoice) {
            $invoice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
