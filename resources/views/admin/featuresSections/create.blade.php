@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.featuresSection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.features-sections.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.featuresSection.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', 'USEFUL FEATURES') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.featuresSection.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_2">{{ trans('cruds.featuresSection.fields.title_2') }}</label>
                <input class="form-control {{ $errors->has('title_2') ? 'is-invalid' : '' }}" type="text" name="title_2" id="title_2" value="{{ old('title_2', 'Everything you need to start your next project') }}">
                @if($errors->has('title_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.featuresSection.fields.title_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_description">{{ trans('cruds.featuresSection.fields.main_description') }}</label>
                <input class="form-control {{ $errors->has('main_description') ? 'is-invalid' : '' }}" type="text" name="main_description" id="main_description" value="{{ old('main_description', 'Not just a set of tools, the package includes ready-to-deploy conceptual application.') }}">
                @if($errors->has('main_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.featuresSection.fields.main_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slide_show">{{ trans('cruds.featuresSection.fields.slide_show') }}</label>
                <div class="needsclick dropzone {{ $errors->has('slide_show') ? 'is-invalid' : '' }}" id="slide_show-dropzone">
                </div>
                @if($errors->has('slide_show'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slide_show') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.featuresSection.fields.slide_show_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="button_text">{{ trans('cruds.featuresSection.fields.button_text') }}</label>
                <input class="form-control {{ $errors->has('button_text') ? 'is-invalid' : '' }}" type="text" name="button_text" id="button_text" value="{{ old('button_text', '') }}">
                @if($errors->has('button_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('button_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.featuresSection.fields.button_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="button_link">{{ trans('cruds.featuresSection.fields.button_link') }}</label>
                <input class="form-control {{ $errors->has('button_link') ? 'is-invalid' : '' }}" type="text" name="button_link" id="button_link" value="{{ old('button_link', '') }}">
                @if($errors->has('button_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('button_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.featuresSection.fields.button_link_helper') }}</span>
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
    var uploadedSlideShowMap = {}
Dropzone.options.slideShowDropzone = {
    url: '{{ route('admin.features-sections.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
      $('form').append('<input type="hidden" name="slide_show[]" value="' + response.name + '">')
      uploadedSlideShowMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSlideShowMap[file.name]
      }
      $('form').find('input[name="slide_show[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($featuresSection) && $featuresSection->slide_show)
      var files = {!! json_encode($featuresSection->slide_show) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="slide_show[]" value="' + file.file_name + '">')
        }
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