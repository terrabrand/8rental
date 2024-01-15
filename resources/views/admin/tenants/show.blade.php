@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tenant.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tenants.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.id') }}
                        </th>
                        <td>
                            {{ $tenant->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.user') }}
                        </th>
                        <td>
                            {{ $tenant->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.property') }}
                        </th>
                        <td>
                            {{ $tenant->property->property_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.unit') }}
                        </th>
                        <td>
                            {{ $tenant->unit->unit_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.first_name') }}
                        </th>
                        <td>
                            {{ $tenant->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.id_type') }}
                        </th>
                        <td>
                            {{ App\Models\Tenant::ID_TYPE_SELECT[$tenant->id_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.id_number') }}
                        </th>
                        <td>
                            {{ $tenant->id_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Tenant::STATUS_SELECT[$tenant->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.monthly_gross_income') }}
                        </th>
                        <td>
                            {{ $tenant->monthly_gross_income }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.additional_income') }}
                        </th>
                        <td>
                            {{ $tenant->additional_income }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.date_of_birth') }}
                        </th>
                        <td>
                            {{ $tenant->date_of_birth }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\Tenant::GENDER_SELECT[$tenant->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.marital_status') }}
                        </th>
                        <td>
                            {{ App\Models\Tenant::MARITAL_STATUS_SELECT[$tenant->marital_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.ethnicity') }}
                        </th>
                        <td>
                            {{ App\Models\Tenant::ETHNICITY_SELECT[$tenant->ethnicity] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.notes') }}
                        </th>
                        <td>
                            {{ $tenant->notes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tenant.fields.image') }}
                        </th>
                        <td>
                            @if($tenant->image)
                                <a href="{{ $tenant->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $tenant->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tenants.index') }}">
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
            <a class="nav-link" href="#tenant_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tenant_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tenant_invoices" role="tab" data-toggle="tab">
                {{ trans('cruds.invoice.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tenant_expenses">
            @includeIf('admin.tenants.relationships.tenantExpenses', ['expenses' => $tenant->tenantExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="tenant_documents">
            @includeIf('admin.tenants.relationships.tenantDocuments', ['documents' => $tenant->tenantDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="tenant_invoices">
            @includeIf('admin.tenants.relationships.tenantInvoices', ['invoices' => $tenant->tenantInvoices])
        </div>
    </div>
</div>

@endsection