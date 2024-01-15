@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.applicationSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.application-settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="application_name">{{ trans('cruds.applicationSetting.fields.application_name') }}</label>
                <input class="form-control {{ $errors->has('application_name') ? 'is-invalid' : '' }}" type="text" name="application_name" id="application_name" value="{{ old('application_name', '') }}">
                @if($errors->has('application_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('application_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicationSetting.fields.application_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="application_logo">{{ trans('cruds.applicationSetting.fields.application_logo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('application_logo') ? 'is-invalid' : '' }}" id="application_logo-dropzone">
                </div>
                @if($errors->has('application_logo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('application_logo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.applicationSetting.fields.application_logo_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.applicationLogoDropzone = {
    url: '{{ route('admin.application-settings.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="application_logo"]').remove()
      $('form').append('<input type="hidden" name="application_logo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="application_logo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($applicationSetting) && $applicationSetting->application_logo)
      var file = {!! json_encode($applicationSetting->application_logo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="application_logo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection