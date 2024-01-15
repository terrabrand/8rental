@extends('layouts.admin')
@section('content')
@can('hero_section_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.hero-sections.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.heroSection.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.heroSection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-HeroSection">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.heroSection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_title_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_button_title') }}
                        </th>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_button_link') }}
                        </th>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.heroSection.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($heroSections as $key => $heroSection)
                        <tr data-entry-id="{{ $heroSection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $heroSection->id ?? '' }}
                            </td>
                            <td>
                                {{ $heroSection->main_title ?? '' }}
                            </td>
                            <td>
                                {{ $heroSection->main_title_description ?? '' }}
                            </td>
                            <td>
                                {{ $heroSection->main_button_title ?? '' }}
                            </td>
                            <td>
                                {{ $heroSection->main_button_link ?? '' }}
                            </td>
                            <td>
                                @if($heroSection->main_image)
                                    <a href="{{ $heroSection->main_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $heroSection->main_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ App\Models\HeroSection::STATUS_SELECT[$heroSection->status] ?? '' }}
                            </td>
                            <td>
                                @can('hero_section_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.hero-sections.show', $heroSection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('hero_section_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.hero-sections.edit', $heroSection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('hero_section_delete')
                                    <form action="{{ route('admin.hero-sections.destroy', $heroSection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('hero_section_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.hero-sections.massDestroy') }}",
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
  let table = $('.datatable-HeroSection:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection