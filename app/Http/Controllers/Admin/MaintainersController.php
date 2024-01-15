<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaintainerRequest;
use App\Http\Requests\StoreMaintainerRequest;
use App\Http\Requests\UpdateMaintainerRequest;
use App\Models\Maintainer;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MaintainersController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('maintainer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintainers = Maintainer::with(['user', 'units_assigneds', 'media'])->get();

        $users = User::get();

        $units = Unit::get();

        return view('admin.maintainers.index', compact('maintainers', 'units', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('maintainer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units_assigneds = Unit::pluck('unit_name', 'id');

        return view('admin.maintainers.create', compact('units_assigneds', 'users'));
    }

    public function store(StoreMaintainerRequest $request)
    {
        $maintainer = Maintainer::create($request->all());
        $maintainer->units_assigneds()->sync($request->input('units_assigneds', []));
        if ($request->input('image', false)) {
            $maintainer->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $maintainer->id]);
        }

        return redirect()->route('admin.maintainers.index');
    }

    public function edit(Maintainer $maintainer)
    {
        abort_if(Gate::denies('maintainer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units_assigneds = Unit::pluck('unit_name', 'id');

        $maintainer->load('user', 'units_assigneds');

        return view('admin.maintainers.edit', compact('maintainer', 'units_assigneds', 'users'));
    }

    public function update(UpdateMaintainerRequest $request, Maintainer $maintainer)
    {
        $maintainer->update($request->all());
        $maintainer->units_assigneds()->sync($request->input('units_assigneds', []));
        if ($request->input('image', false)) {
            if (! $maintainer->image || $request->input('image') !== $maintainer->image->file_name) {
                if ($maintainer->image) {
                    $maintainer->image->delete();
                }
                $maintainer->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($maintainer->image) {
            $maintainer->image->delete();
        }

        return redirect()->route('admin.maintainers.index');
    }

    public function show(Maintainer $maintainer)
    {
        abort_if(Gate::denies('maintainer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintainer->load('user', 'units_assigneds');

        return view('admin.maintainers.show', compact('maintainer'));
    }

    public function destroy(Maintainer $maintainer)
    {
        abort_if(Gate::denies('maintainer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $maintainer->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaintainerRequest $request)
    {
        $maintainers = Maintainer::find(request('ids'));

        foreach ($maintainers as $maintainer) {
            $maintainer->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('maintainer_create') && Gate::denies('maintainer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Maintainer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
