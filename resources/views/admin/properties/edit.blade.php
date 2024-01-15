@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.property.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.properties.update", [$property->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="property_name">{{ trans('cruds.property.fields.property_name') }}</label>
                <input class="form-control {{ $errors->has('property_name') ? 'is-invalid' : '' }}" type="text" name="property_name" id="property_name" value="{{ old('property_name', $property->property_name) }}" required>
                @if($errors->has('property_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('property_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.property_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="landlord_id">{{ trans('cruds.property.fields.landlord') }}</label>
                <select class="form-control select2 {{ $errors->has('landlord') ? 'is-invalid' : '' }}" name="landlord_id" id="landlord_id">
                    @foreach($landlords as $id => $entry)
                        <option value="{{ $id }}" {{ (old('landlord_id') ? old('landlord_id') : $property->landlord->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('landlord'))
                    <div class="invalid-feedback">
                        {{ $errors->first('landlord') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.landlord_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_image">{{ trans('cruds.property.fields.main_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('main_image') ? 'is-invalid' : '' }}" id="main_image-dropzone">
                </div>
                @if($errors->has('main_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.main_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.property.fields.property_type') }}</label>
                <select class="form-control {{ $errors->has('property_type') ? 'is-invalid' : '' }}" name="property_type" id="property_type">
                    <option value disabled {{ old('property_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Property::PROPERTY_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('property_type', $property->property_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('property_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('property_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.property_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="location">{{ trans('cruds.property.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="text" name="location" id="location" value="{{ old('location', $property->location) }}">
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tenants">{{ trans('cruds.property.fields.tenant') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tenants') ? 'is-invalid' : '' }}" name="tenants[]" id="tenants" multiple>
                    @foreach($tenants as $id => $tenant)
                        <option value="{{ $id }}" {{ (in_array($id, old('tenants', [])) || $property->tenants->contains($id)) ? 'selected' : '' }}>{{ $tenant }}</option>
                    @endforeach
                </select>
                @if($errors->has('tenants'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tenants') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.tenant_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="maintainer_id">{{ trans('cruds.property.fields.maintainer') }}</label>
                <select class="form-control select2 {{ $errors->has('maintainer') ? 'is-invalid' : '' }}" name="maintainer_id" id="maintainer_id">
                    @foreach($maintainers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('maintainer_id') ? old('maintainer_id') : $property->maintainer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('maintainer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('maintainer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.maintainer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="more_images">{{ trans('cruds.property.fields.more_images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('more_images') ? 'is-invalid' : '' }}" id="more_images-dropzone">
                </div>
                @if($errors->has('more_images'))
                    <div class="invalid-feedback">
                        {{ $errors->first('more_images') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.property.fields.more_images_helper') }}</span>
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
    url: '{{ route('admin.properties.storeMedia') }}',
    maxFilesize: 1, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1
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
@if(isset($property) && $property->main_image)
      var file = {!! json_encode($property->main_image) !!}
          this.options.addedfile.call(this, file)
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
<script>
    var uploadedMoreImagesMap = {}
Dropzone.options.moreImagesDropzone = {
    url: '{{ route('admin.properties.storeMedia') }}',
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
      $('form').append('<input type="hidden" name="more_images[]" value="' + response.name + '">')
      uploadedMoreImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedMoreImagesMap[file.name]
      }
      $('form').find('input[name="more_images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($property) && $property->more_images)
      var files = {!! json_encode($property->more_images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="more_images[]" value="' + file.file_name + '">')
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