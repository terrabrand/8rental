@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.application.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.applications.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.application.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.application.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="property_applying_id">{{ trans('cruds.application.fields.property_applying') }}</label>
                <select class="form-control select2 {{ $errors->has('property_applying') ? 'is-invalid' : '' }}" name="property_applying_id" id="property_applying_id" required>
                    @foreach($property_applyings as $id => $entry)
                        <option value="{{ $id }}" {{ old('property_applying_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('property_applying'))
                    <div class="invalid-feedback">
                        {{ $errors->first('property_applying') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.application.fields.property_applying_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="unit_applying_id">{{ trans('cruds.application.fields.unit_applying') }}</label>
                <select class="form-control select2 {{ $errors->has('unit_applying') ? 'is-invalid' : '' }}" name="unit_applying_id" id="unit_applying_id" required>
                    @foreach($unit_applyings as $id => $entry)
                        <option value="{{ $id }}" {{ old('unit_applying_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit_applying'))
                    <div class="invalid-feedback">
                        {{ $errors->first('unit_applying') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.application.fields.unit_applying_helper') }}</span>
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