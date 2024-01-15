@extends('layouts.admin')
@section('content')
@can('features_section_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.features-sections.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.featuresSection.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.featuresSection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-FeaturesSection">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.featuresSection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.featuresSection.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.featuresSection.fields.title_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.featuresSection.fields.main_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.featuresSection.fields.slide_show') }}
                        </th>
                        <th>
                            {{ trans('cruds.featuresSection.fields.button_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.featuresSection.fields.button_link') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($featuresSections as $key => $featuresSection)
                        <tr data-entry-id="{{ $featuresSection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $featuresSection->id ?? '' }}
                            </td>
                            <td>
                                {{ $featuresSection->title ?? '' }}
                            </td>
                            <td>
                                {{ $featuresSection->title_2 ?? '' }}
                            </td>
                            <td>
                                {{ $featuresSection->main_description ?? '' }}
                            </td>
                            <td>
                                @foreach($featuresSection->slide_show as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $featuresSection->button_text ?? '' }}
                            </td>
                            <td>
                                {{ $featuresSection->button_link ?? '' }}
                            </td>
                            <td>
                                @can('features_section_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.features-sections.show', $featuresSection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('features_section_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.features-sections.edit', $featuresSection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('features_section_delete')
                                    <form action="{{ route('admin.features-sections.destroy', $featuresSection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('features_section_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.features-sections.massDestroy') }}",
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
  let table = $('.datatable-FeaturesSection:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection