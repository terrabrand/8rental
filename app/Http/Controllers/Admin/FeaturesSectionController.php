<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFeaturesSectionRequest;
use App\Http\Requests\StoreFeaturesSectionRequest;
use App\Http\Requests\UpdateFeaturesSectionRequest;
use App\Models\FeaturesSection;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class FeaturesSectionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('features_section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $featuresSections = FeaturesSection::with(['media'])->get();

        return view('admin.featuresSections.index', compact('featuresSections'));
    }

    public function create()
    {
        abort_if(Gate::denies('features_section_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.featuresSections.create');
    }

    public function store(StoreFeaturesSectionRequest $request)
    {
        $featuresSection = FeaturesSection::create($request->all());

        foreach ($request->input('slide_show', []) as $file) {
            $featuresSection->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('slide_show');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $featuresSection->id]);
        }

        return redirect()->route('admin.features-sections.index');
    }

    public function edit(FeaturesSection $featuresSection)
    {
        abort_if(Gate::denies('features_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.featuresSections.edit', compact('featuresSection'));
    }

    public function update(UpdateFeaturesSectionRequest $request, FeaturesSection $featuresSection)
    {
        $featuresSection->update($request->all());

        if (count($featuresSection->slide_show) > 0) {
            foreach ($featuresSection->slide_show as $media) {
                if (! in_array($media->file_name, $request->input('slide_show', []))) {
                    $media->delete();
                }
            }
        }
        $media = $featuresSection->slide_show->pluck('file_name')->toArray();
        foreach ($request->input('slide_show', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $featuresSection->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('slide_show');
            }
        }

        return redirect()->route('admin.features-sections.index');
    }

    public function show(FeaturesSection $featuresSection)
    {
        abort_if(Gate::denies('features_section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.featuresSections.show', compact('featuresSection'));
    }

    public function destroy(FeaturesSection $featuresSection)
    {
        abort_if(Gate::denies('features_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $featuresSection->delete();

        return back();
    }

    public function massDestroy(MassDestroyFeaturesSectionRequest $request)
    {
        $featuresSections = FeaturesSection::find(request('ids'));

        foreach ($featuresSections as $featuresSection) {
            $featuresSection->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('features_section_create') && Gate::denies('features_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new FeaturesSection();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
