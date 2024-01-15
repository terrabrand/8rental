@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.invoiceRecurring.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoice-recurrings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.id') }}
                        </th>
                        <td>
                            {{ $invoiceRecurring->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.property') }}
                        </th>
                        <td>
                            {{ $invoiceRecurring->property->property_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.unit') }}
                        </th>
                        <td>
                            {{ $invoiceRecurring->unit->unit_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.amount') }}
                        </th>
                        <td>
                            {{ $invoiceRecurring->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.billing_cycle') }}
                        </th>
                        <td>
                            {{ App\Models\InvoiceRecurring::BILLING_CYCLE_SELECT[$invoiceRecurring->billing_cycle] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.start_date') }}
                        </th>
                        <td>
                            {{ $invoiceRecurring->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.end_date') }}
                        </th>
                        <td>
                            {{ $invoiceRecurring->end_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.invoice-recurrings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection