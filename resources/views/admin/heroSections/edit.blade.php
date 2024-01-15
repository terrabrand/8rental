@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.heroSection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hero-sections.update", [$heroSection->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="main_title">{{ trans('cruds.heroSection.fields.main_title') }}</label>
                <input class="form-control {{ $errors->has('main_title') ? 'is-invalid' : '' }}" type="text" name="main_title" id="main_title" value="{{ old('main_title', $heroSection->main_title) }}" required>
                @if($errors->has('main_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.heroSection.fields.main_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="main_title_description">{{ trans('cruds.heroSection.fields.main_title_description') }}</label>
                <input class="form-control {{ $errors->has('main_title_description') ? 'is-invalid' : '' }}" type="text" name="main_title_description" id="main_title_description" value="{{ old('main_title_description', $heroSection->main_title_description) }}" required>
                @if($errors->has('main_title_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_title_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.heroSection.fields.main_title_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="main_button_title">{{ trans('cruds.heroSection.fields.main_button_title') }}</label>
                <input class="form-control {{ $errors->has('main_button_title') ? 'is-invalid' : '' }}" type="text" name="main_button_title" id="main_button_title" value="{{ old('main_button_title', $heroSection->main_button_title) }}" required>
                @if($errors->has('main_button_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_button_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.heroSection.fields.main_button_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="main_button_link">{{ trans('cruds.heroSection.fields.main_button_link') }}</label>
                <input class="form-control {{ $errors->has('main_button_link') ? 'is-invalid' : '' }}" type="text" name="main_button_link" id="main_button_link" value="{{ old('main_button_link', $heroSection->main_button_link) }}" required>
                @if($errors->has('main_button_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_button_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.heroSection.fields.main_button_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="main_image">{{ trans('cruds.heroSection.fields.main_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('main_image') ? 'is-invalid' : '' }}" id="main_image-dropzone">
                </div>
                @if($errors->has('main_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.heroSection.fields.main_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.heroSection.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\HeroSection::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $heroSection->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.heroSection.fields.status_helper') }}</span>
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
    Dropzone.options.mainImageDropzone = {
    url: '{{ route('admin.hero-sections.storeMedia') }}',
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
      $('form').find('input[name="main_image"]').remove()
      $('form').append('<input type="hidden" name="main_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="main_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($heroSection) && $heroSection->main_image)
      var file = {!! json_encode($heroSection->main_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="main_image" value="' + file.file_name + '">')
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