<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLandlordRequest;
use App\Http\Requests\StoreLandlordRequest;
use App\Http\Requests\UpdateLandlordRequest;
use App\Models\Landlord;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandlordController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('landlord_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landlords = Landlord::with(['user'])->get();

        return view('admin.landlords.index', compact('landlords'));
    }

    public function create()
    {
        abort_if(Gate::denies('landlord_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.landlords.create', compact('users'));
    }

    public function store(StoreLandlordRequest $request)
    {
        $landlord = Landlord::create($request->all());

        return redirect()->route('admin.landlords.index');
    }

    public function edit(Landlord $landlord)
    {
        abort_if(Gate::denies('landlord_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landlord->load('user');

        return view('admin.landlords.edit', compact('landlord', 'users'));
    }

    public function update(UpdateLandlordRequest $request, Landlord $landlord)
    {
        $landlord->update($request->all());

        return redirect()->route('admin.landlords.index');
    }

    public function show(Landlord $landlord)
    {
        abort_if(Gate::denies('landlord_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landlord->load('user', 'landlordProperties', 'landlordExpenses', 'landlordDocuments', 'landlordInvoices');

        return view('admin.landlords.show', compact('landlord'));
    }

    public function destroy(Landlord $landlord)
    {
        abort_if(Gate::denies('landlord_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landlord->delete();

        return back();
    }

    public function massDestroy(MassDestroyLandlordRequest $request)
    {
        $landlords = Landlord::find(request('ids'));

        foreach ($landlords as $landlord) {
            $landlord->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
