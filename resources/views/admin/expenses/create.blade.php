@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.expense.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.expenses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.expense.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="landlords">{{ trans('cruds.expense.fields.landlord') }}</label>
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
                <span class="help-block">{{ trans('cruds.expense.fields.landlord_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="properties">{{ trans('cruds.expense.fields.property') }}</label>
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
                <span class="help-block">{{ trans('cruds.expense.fields.property_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="units">{{ trans('cruds.expense.fields.unit') }}</label>
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
                <span class="help-block">{{ trans('cruds.expense.fields.unit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tenants">{{ trans('cruds.expense.fields.tenant') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tenants') ? 'is-invalid' : '' }}" name="tenants[]" id="tenants" multiple>
                    @foreach($tenants as $id => $tenant)
                        <option value="{{ $id }}" {{ in_array($id, old('tenants', [])) ? 'selected' : '' }}>{{ $tenant }}</option>
                    @endforeach
                </select>
                @if($errors->has('tenants'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tenants') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.tenant_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.expense.fields.responsible') }}</label>
                <select class="form-control {{ $errors->has('responsible') ? 'is-invalid' : '' }}" name="responsible" id="responsible">
                    <option value disabled {{ old('responsible', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Expense::RESPONSIBLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('responsible', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('responsible'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsible') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.responsible_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="expense_types">{{ trans('cruds.expense.fields.expense_type') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('expense_types') ? 'is-invalid' : '' }}" name="expense_types[]" id="expense_types" multiple required>
                    @foreach($expense_types as $id => $expense_type)
                        <option value="{{ $id }}" {{ in_array($id, old('expense_types', [])) ? 'selected' : '' }}>{{ $expense_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('expense_types'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expense_types') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.expense_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.expense.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.expense.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="0.01">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.expense.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Expense::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'pending') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.expense.fields.status_helper') }}</span>
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