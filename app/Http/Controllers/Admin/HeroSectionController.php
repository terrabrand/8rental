<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHeroSectionRequest;
use App\Http\Requests\StoreHeroSectionRequest;
use App\Http\Requests\UpdateHeroSectionRequest;
use App\Models\HeroSection;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HeroSectionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('hero_section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $heroSections = HeroSection::with(['media'])->get();

        return view('admin.heroSections.index', compact('heroSections'));
    }

    public function create()
    {
        abort_if(Gate::denies('hero_section_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.heroSections.create');
    }

    public function store(StoreHeroSectionRequest $request)
    {
        $heroSection = HeroSection::create($request->all());

        if ($request->input('main_image', false)) {
            $heroSection->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_image'))))->toMediaCollection('main_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $heroSection->id]);
        }

        return redirect()->route('admin.hero-sections.index');
    }

    public function edit(HeroSection $heroSection)
    {
        abort_if(Gate::denies('hero_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.heroSections.edit', compact('heroSection'));
    }

    public function update(UpdateHeroSectionRequest $request, HeroSection $heroSection)
    {
        $heroSection->update($request->all());

        if ($request->input('main_image', false)) {
            if (! $heroSection->main_image || $request->input('main_image') !== $heroSection->main_image->file_name) {
                if ($heroSection->main_image) {
                    $heroSection->main_image->delete();
                }
                $heroSection->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_image'))))->toMediaCollection('main_image');
            }
        } elseif ($heroSection->main_image) {
            $heroSection->main_image->delete();
        }

        return redirect()->route('admin.hero-sections.index');
    }

    public function show(HeroSection $heroSection)
    {
        abort_if(Gate::denies('hero_section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.heroSections.show', compact('heroSection'));
    }

    public function destroy(HeroSection $heroSection)
    {
        abort_if(Gate::denies('hero_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $heroSection->delete();

        return back();
    }

    public function massDestroy(MassDestroyHeroSectionRequest $request)
    {
        $heroSections = HeroSection::find(request('ids'));

        foreach ($heroSections as $heroSection) {
            $heroSection->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hero_section_create') && Gate::denies('hero_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HeroSection();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
