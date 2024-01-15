@extends('layouts.admin')
@section('content')
@can('maintainer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.maintainers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.maintainer.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Maintainer', 'route' => 'admin.maintainers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.maintainer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Maintainer">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.maintainer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.maintainer.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.maintainer.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.maintainer.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.maintainer.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.maintainer.fields.units_assigned') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($units as $key => $item)
                                    <option value="{{ $item->unit_name }}">{{ $item->unit_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maintainers as $key => $maintainer)
                        <tr data-entry-id="{{ $maintainer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $maintainer->id ?? '' }}
                            </td>
                            <td>
                                {{ $maintainer->user->name ?? '' }}
                            </td>
                            <td>
                                @if($maintainer->image)
                                    <a href="{{ $maintainer->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $maintainer->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $maintainer->email ?? '' }}
                            </td>
                            <td>
                                {{ $maintainer->phone_number ?? '' }}
                            </td>
                            <td>
                                @foreach($maintainer->units_assigneds as $key => $item)
                                    <span class="badge badge-info">{{ $item->unit_name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('maintainer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.maintainers.show', $maintainer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('maintainer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.maintainers.edit', $maintainer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('maintainer_delete')
                                    <form action="{{ route('admin.maintainers.destroy', $maintainer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('maintainer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.maintainers.massDestroy') }}",
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
  let table = $('.datatable-Maintainer:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection