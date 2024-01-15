@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.invoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.invoices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.invoice.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tenants">{{ trans('cruds.invoice.fields.tenant') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tenants') ? 'is-invalid' : '' }}" name="tenants[]" id="tenants" multiple required>
                    @foreach($tenants as $id => $tenant)
                        <option value="{{ $id }}" {{ in_array($id, old('tenants', [])) ? 'selected' : '' }}>{{ $tenant }}</option>
                    @endforeach
                </select>
                @if($errors->has('tenants'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tenants') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.tenant_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="landlords">{{ trans('cruds.invoice.fields.landlord') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('landlords') ? 'is-invalid' : '' }}" name="landlords[]" id="landlords" multiple>
                    @foreach($landlords as $id => $landlord)
                        <option value="{{ $id }}" {{ in_array($id, old('landlords', [])) ? 'selected' : '' }}>{{ $landlord }}</option>
                    @endforeach
                </select>
                @if($errors->has('landlords'))
                    <div class="invalid-feedback">
                        {{ $errors->first('landlords') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.landlord_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="invoice_types">{{ trans('cruds.invoice.fields.invoice_type') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('invoice_types') ? 'is-invalid' : '' }}" name="invoice_types[]" id="invoice_types" multiple>
                    @foreach($invoice_types as $id => $invoice_type)
                        <option value="{{ $id }}" {{ in_array($id, old('invoice_types', [])) ? 'selected' : '' }}>{{ $invoice_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('invoice_types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('invoice_types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.invoice_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="properties">{{ trans('cruds.invoice.fields.property') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('properties') ? 'is-invalid' : '' }}" name="properties[]" id="properties" multiple>
                    @foreach($properties as $id => $property)
                        <option value="{{ $id }}" {{ in_array($id, old('properties', [])) ? 'selected' : '' }}>{{ $property }}</option>
                    @endforeach
                </select>
                @if($errors->has('properties'))
                    <div class="invalid-feedback">
                        {{ $errors->first('properties') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.property_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sections">{{ trans('cruds.invoice.fields.section') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('sections') ? 'is-invalid' : '' }}" name="sections[]" id="sections" multiple>
                    @foreach($sections as $id => $section)
                        <option value="{{ $id }}" {{ in_array($id, old('sections', [])) ? 'selected' : '' }}>{{ $section }}</option>
                    @endforeach
                </select>
                @if($errors->has('sections'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sections') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.section_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="units">{{ trans('cruds.invoice.fields.unit') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('units') ? 'is-invalid' : '' }}" name="units[]" id="units" multiple>
                    @foreach($units as $id => $unit)
                        <option value="{{ $id }}" {{ in_array($id, old('units', [])) ? 'selected' : '' }}>{{ $unit }}</option>
                    @endforeach
                </select>
                @if($errors->has('units'))
                    <div class="invalid-feedback">
                        {{ $errors->first('units') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="invoice_number">{{ trans('cruds.invoice.fields.invoice_number') }}</label>
                <input class="form-control {{ $errors->has('invoice_number') ? 'is-invalid' : '' }}" type="text" name="invoice_number" id="invoice_number" value="{{ old('invoice_number', '') }}">
                @if($errors->has('invoice_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('invoice_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.invoice_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.invoice.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_due">{{ trans('cruds.invoice.fields.date_due') }}</label>
                <input class="form-control date {{ $errors->has('date_due') ? 'is-invalid' : '' }}" type="text" name="date_due" id="date_due" value="{{ old('date_due') }}">
                @if($errors->has('date_due'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_due') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.date_due_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.invoice.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01" required>
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tax">{{ trans('cruds.invoice.fields.tax') }}</label>
                <input class="form-control {{ $errors->has('tax') ? 'is-invalid' : '' }}" type="number" name="tax" id="tax" value="{{ old('tax', '0.00') }}" step="0.01">
                @if($errors->has('tax'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tax') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.tax_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.invoice.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Invoice::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.status_helper') }}</span>
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