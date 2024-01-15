<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTenantRequest;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Unit;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TenantController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('tenant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenants = Tenant::with(['user', 'property', 'unit', 'media'])->get();

        $users = User::get();

        $properties = Property::get();

        $units = Unit::get();

        return view('admin.tenants.index', compact('properties', 'tenants', 'units', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('tenant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('property_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('unit_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tenants.create', compact('properties', 'units', 'users'));
    }

    public function store(StoreTenantRequest $request)
    {
        $tenant = Tenant::create($request->all());

        if ($request->input('image', false)) {
            $tenant->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tenant->id]);
        }

        return redirect()->route('admin.tenants.index');
    }

    public function edit(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $properties = Property::pluck('property_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $units = Unit::pluck('unit_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tenant->load('user', 'property', 'unit');

        return view('admin.tenants.edit', compact('properties', 'tenant', 'units', 'users'));
    }

    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $tenant->update($request->all());

        if ($request->input('image', false)) {
            if (! $tenant->image || $request->input('image') !== $tenant->image->file_name) {
                if ($tenant->image) {
                    $tenant->image->delete();
                }
                $tenant->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($tenant->image) {
            $tenant->image->delete();
        }

        return redirect()->route('admin.tenants.index');
    }

    public function show(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenant->load('user', 'property', 'unit', 'tenantExpenses', 'tenantDocuments', 'tenantInvoices');

        return view('admin.tenants.show', compact('tenant'));
    }

    public function destroy(Tenant $tenant)
    {
        abort_if(Gate::denies('tenant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tenant->delete();

        return back();
    }

    public function massDestroy(MassDestroyTenantRequest $request)
    {
        $tenants = Tenant::find(request('ids'));

        foreach ($tenants as $tenant) {
            $tenant->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('tenant_create') && Gate::denies('tenant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Tenant();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
