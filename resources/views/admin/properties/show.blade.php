@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.property.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.id') }}
                        </th>
                        <td>
                            {{ $property->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.property_name') }}
                        </th>
                        <td>
                            {{ $property->property_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.landlord') }}
                        </th>
                        <td>
                            {{ $property->landlord->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.main_image') }}
                        </th>
                        <td>
                            @if($property->main_image)
                                <a href="{{ $property->main_image->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.property_type') }}
                        </th>
                        <td>
                            {{ App\Models\Property::PROPERTY_TYPE_SELECT[$property->property_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.location') }}
                        </th>
                        <td>
                            {{ $property->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.tenant') }}
                        </th>
                        <td>
                            @foreach($property->tenants as $key => $tenant)
                                <span class="label label-info">{{ $tenant->first_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.maintainer') }}
                        </th>
                        <td>
                            {{ $property->maintainer->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.property.fields.more_images') }}
                        </th>
                        <td>
                            @foreach($property->more_images as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.properties.index') }}">
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
            <a class="nav-link" href="#property_sections" role="tab" data-toggle="tab">
                {{ trans('cruds.section.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#unit_property_units" role="tab" data-toggle="tab">
                {{ trans('cruds.unit.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#property_tenants" role="tab" data-toggle="tab">
                {{ trans('cruds.tenant.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#property_applying_applications" role="tab" data-toggle="tab">
                {{ trans('cruds.application.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#property_invoice_recurrings" role="tab" data-toggle="tab">
                {{ trans('cruds.invoiceRecurring.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#property_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#property_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#property_invoices" role="tab" data-toggle="tab">
                {{ trans('cruds.invoice.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="property_sections">
            @includeIf('admin.properties.relationships.propertySections', ['sections' => $property->propertySections])
        </div>
        <div class="tab-pane" role="tabpanel" id="unit_property_units">
            @includeIf('admin.properties.relationships.unitPropertyUnits', ['units' => $property->unitPropertyUnits])
        </div>
        <div class="tab-pane" role="tabpanel" id="property_tenants">
            @includeIf('admin.properties.relationships.propertyTenants', ['tenants' => $property->propertyTenants])
        </div>
        <div class="tab-pane" role="tabpanel" id="property_applying_applications">
            @includeIf('admin.properties.relationships.propertyApplyingApplications', ['applications' => $property->propertyApplyingApplications])
        </div>
        <div class="tab-pane" role="tabpanel" id="property_invoice_recurrings">
            @includeIf('admin.properties.relationships.propertyInvoiceRecurrings', ['invoiceRecurrings' => $property->propertyInvoiceRecurrings])
        </div>
        <div class="tab-pane" role="tabpanel" id="property_expenses">
            @includeIf('admin.properties.relationships.propertyExpenses', ['expenses' => $property->propertyExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="property_documents">
            @includeIf('admin.properties.relationships.propertyDocuments', ['documents' => $property->propertyDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="property_invoices">
            @includeIf('admin.properties.relationships.propertyInvoices', ['invoices' => $property->propertyInvoices])
        </div>
    </div>
</div>

@endsection