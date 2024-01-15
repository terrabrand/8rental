@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.unit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.id') }}
                        </th>
                        <td>
                            {{ $unit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.unit_name') }}
                        </th>
                        <td>
                            {{ $unit->unit_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.unit_property') }}
                        </th>
                        <td>
                            {{ $unit->unit_property->property_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.unit_section') }}
                        </th>
                        <td>
                            {{ $unit->unit_section->section_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.rent_price') }}
                        </th>
                        <td>
                            {{ $unit->rent_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.unit_size') }}
                        </th>
                        <td>
                            {{ $unit->unit_size }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.number_of_bedrooms') }}
                        </th>
                        <td>
                            {{ $unit->number_of_bedrooms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.number_of_kitchens') }}
                        </th>
                        <td>
                            {{ $unit->number_of_kitchens }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.number_of_bathrooms') }}
                        </th>
                        <td>
                            {{ $unit->number_of_bathrooms }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.market_rent') }}
                        </th>
                        <td>
                            {{ $unit->market_rent }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.cover_image') }}
                        </th>
                        <td>
                            @if($unit->cover_image)
                                <a href="{{ $unit->cover_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $unit->cover_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.deposit_amount') }}
                        </th>
                        <td>
                            {{ $unit->deposit_amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.parking_type') }}
                        </th>
                        <td>
                            {{ App\Models\Unit::PARKING_TYPE_SELECT[$unit->parking_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.unit_images') }}
                        </th>
                        <td>
                            @foreach($unit->unit_images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.unit.fields.notes') }}
                        </th>
                        <td>
                            {{ $unit->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.units.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#unit_applying_applications" role="tab" data-toggle="tab">
                {{ trans('cruds.application.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_invoice_recurrings" role="tab" data-toggle="tab">
                {{ trans('cruds.invoiceRecurring.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_invoices" role="tab" data-toggle="tab">
                {{ trans('cruds.invoice.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="unit_applying_applications">
            @includeIf('admin.units.relationships.unitApplyingApplications', ['applications' => $unit->unitApplyingApplications])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_invoice_recurrings">
            @includeIf('admin.units.relationships.unitInvoiceRecurrings', ['invoiceRecurrings' => $unit->unitInvoiceRecurrings])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_expenses">
            @includeIf('admin.units.relationships.unitExpenses', ['expenses' => $unit->unitExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_documents">
            @includeIf('admin.units.relationships.unitDocuments', ['documents' => $unit->unitDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_invoices">
            @includeIf('admin.units.relationships.unitInvoices', ['invoices' => $unit->unitInvoices])
        </div>
    </div>
</div>

@endsection