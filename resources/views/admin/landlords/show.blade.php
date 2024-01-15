@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.landlord.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.landlords.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.id') }}
                        </th>
                        <td>
                            {{ $landlord->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.user') }}
                        </th>
                        <td>
                            {{ $landlord->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.name') }}
                        </th>
                        <td>
                            {{ $landlord->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.company_name') }}
                        </th>
                        <td>
                            {{ $landlord->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $landlord->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.country') }}
                        </th>
                        <td>
                            {{ $landlord->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.city') }}
                        </th>
                        <td>
                            {{ $landlord->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landlord.fields.state') }}
                        </th>
                        <td>
                            {{ $landlord->state }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.landlords.index') }}">
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
            <a class="nav-link" href="#landlord_properties" role="tab" data-toggle="tab">
                {{ trans('cruds.property.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#landlord_expenses" role="tab" data-toggle="tab">
                {{ trans('cruds.expense.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#landlord_documents" role="tab" data-toggle="tab">
                {{ trans('cruds.document.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#landlord_invoices" role="tab" data-toggle="tab">
                {{ trans('cruds.invoice.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="landlord_properties">
            @includeIf('admin.landlords.relationships.landlordProperties', ['properties' => $landlord->landlordProperties])
        </div>
        <div class="tab-pane" role="tabpanel" id="landlord_expenses">
            @includeIf('admin.landlords.relationships.landlordExpenses', ['expenses' => $landlord->landlordExpenses])
        </div>
        <div class="tab-pane" role="tabpanel" id="landlord_documents">
            @includeIf('admin.landlords.relationships.landlordDocuments', ['documents' => $landlord->landlordDocuments])
        </div>
        <div class="tab-pane" role="tabpanel" id="landlord_invoices">
            @includeIf('admin.landlords.relationships.landlordInvoices', ['invoices' => $landlord->landlordInvoices])
        </div>
    </div>
</div>

@endsection