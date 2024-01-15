@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.heroSection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hero-sections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.heroSection.fields.id') }}
                        </th>
                        <td>
                            {{ $heroSection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_title') }}
                        </th>
                        <td>
                            {{ $heroSection->main_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_title_description') }}
                        </th>
                        <td>
                            {{ $heroSection->main_title_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_button_title') }}
                        </th>
                        <td>
                            {{ $heroSection->main_button_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_button_link') }}
                        </th>
                        <td>
                            {{ $heroSection->main_button_link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.heroSection.fields.main_image') }}
                        </th>
                        <td>
                            @if($heroSection->main_image)
                                <a href="{{ $heroSection->main_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $heroSection->main_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.heroSection.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\HeroSection::STATUS_SELECT[$heroSection->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hero-sections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection