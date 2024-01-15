@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.featuresSection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.features-sections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.featuresSection.fields.id') }}
                        </th>
                        <td>
                            {{ $featuresSection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.featuresSection.fields.title') }}
                        </th>
                        <td>
                            {{ $featuresSection->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.featuresSection.fields.title_2') }}
                        </th>
                        <td>
                            {{ $featuresSection->title_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.featuresSection.fields.main_description') }}
                        </th>
                        <td>
                            {{ $featuresSection->main_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.featuresSection.fields.slide_show') }}
                        </th>
                        <td>
                            @foreach($featuresSection->slide_show as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.featuresSection.fields.button_text') }}
                        </th>
                        <td>
                            {{ $featuresSection->button_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.featuresSection.fields.button_link') }}
                        </th>
                        <td>
                            {{ $featuresSection->button_link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.features-sections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection