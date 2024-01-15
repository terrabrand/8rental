@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.maintainer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.maintainers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.maintainer.fields.id') }}
                        </th>
                        <td>
                            {{ $maintainer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintainer.fields.user') }}
                        </th>
                        <td>
                            {{ $maintainer->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintainer.fields.image') }}
                        </th>
                        <td>
                            @if($maintainer->image)
                                <a href="{{ $maintainer->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $maintainer->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintainer.fields.email') }}
                        </th>
                        <td>
                            {{ $maintainer->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintainer.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintainer.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $maintainer->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.maintainer.fields.units_assigned') }}
                        </th>
                        <td>
                            @foreach($maintainer->units_assigneds as $key => $units_assigned)
                                <span class="label label-info">{{ $units_assigned->unit_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.maintainers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection