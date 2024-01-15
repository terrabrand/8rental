@extends('layouts.admin')
@section('content')
@can('invoice_recurring_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.invoice-recurrings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.invoiceRecurring.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'InvoiceRecurring', 'route' => 'admin.invoice-recurrings.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.invoiceRecurring.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-InvoiceRecurring">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.property') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.unit') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.billing_cycle') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.invoiceRecurring.fields.end_date') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoiceRecurrings as $key => $invoiceRecurring)
                        <tr data-entry-id="{{ $invoiceRecurring->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $invoiceRecurring->id ?? '' }}
                            </td>
                            <td>
                                {{ $invoiceRecurring->property->property_name ?? '' }}
                            </td>
                            <td>
                                {{ $invoiceRecurring->unit->unit_name ?? '' }}
                            </td>
                            <td>
                                {{ $invoiceRecurring->amount ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\InvoiceRecurring::BILLING_CYCLE_SELECT[$invoiceRecurring->billing_cycle] ?? '' }}
                            </td>
                            <td>
                                {{ $invoiceRecurring->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $invoiceRecurring->end_date ?? '' }}
                            </td>
                            <td>
                                @can('invoice_recurring_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.invoice-recurrings.show', $invoiceRecurring->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('invoice_recurring_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.invoice-recurrings.edit', $invoiceRecurring->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('invoice_recurring_delete')
                                    <form action="{{ route('admin.invoice-recurrings.destroy', $invoiceRecurring->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('invoice_recurring_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.invoice-recurrings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-InvoiceRecurring:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection