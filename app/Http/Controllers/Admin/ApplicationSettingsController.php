<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyApplicationSettingRequest;
use App\Http\Requests\StoreApplicationSettingRequest;
use App\Http\Requests\UpdateApplicationSettingRequest;
use App\Models\ApplicationSetting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ApplicationSettingsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('application_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicationSettings = ApplicationSetting::with(['media'])->get();

        return view('admin.applicationSettings.index', compact('applicationSettings'));
    }

    public function create()
    {
        abort_if(Gate::denies('application_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.applicationSettings.create');
    }

    public function store(StoreApplicationSettingRequest $request)
    {
        $applicationSetting = ApplicationSetting::create($request->all());

        if ($request->input('application_logo', false)) {
            $applicationSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('application_logo'))))->toMediaCollection('application_logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $applicationSetting->id]);
        }

        return redirect()->route('admin.application-settings.index');
    }

    public function edit(ApplicationSetting $applicationSetting)
    {
        abort_if(Gate::denies('application_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.applicationSettings.edit', compact('applicationSetting'));
    }

    public function update(UpdateApplicationSettingRequest $request, ApplicationSetting $applicationSetting)
    {
        $applicationSetting->update($request->all());

        if ($request->input('application_logo', false)) {
            if (! $applicationSetting->application_logo || $request->input('application_logo') !== $applicationSetting->application_logo->file_name) {
                if ($applicationSetting->application_logo) {
                    $applicationSetting->application_logo->delete();
                }
                $applicationSetting->addMedia(storage_path('tmp/uploads/' . basename($request->input('application_logo'))))->toMediaCollection('application_logo');
            }
        } elseif ($applicationSetting->application_logo) {
            $applicationSetting->application_logo->delete();
        }

        return redirect()->route('admin.application-settings.index');
    }

    public function show(ApplicationSetting $applicationSetting)
    {
        abort_if(Gate::denies('application_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.applicationSettings.show', compact('applicationSetting'));
    }

    public function destroy(ApplicationSetting $applicationSetting)
    {
        abort_if(Gate::denies('application_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicationSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyApplicationSettingRequest $request)
    {
        $applicationSettings = ApplicationSetting::find(request('ids'));

        foreach ($applicationSettings as $applicationSetting) {
            $applicationSetting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('application_setting_create') && Gate::denies('application_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ApplicationSetting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
