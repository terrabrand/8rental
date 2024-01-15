<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandlordRequest;
use App\Http\Requests\UpdateLandlordRequest;
use App\Http\Resources\Admin\LandlordResource;
use App\Models\Landlord;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandlordApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('landlord_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandlordResource(Landlord::with(['user'])->get());
    }

    public function store(StoreLandlordRequest $request)
    {
        $landlord = Landlord::create($request->all());

        return (new LandlordResource($landlord))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Landlord $landlord)
    {
        abort_if(Gate::denies('landlord_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandlordResource($landlord->load(['user']));
    }

    public function update(UpdateLandlordRequest $request, Landlord $landlord)
    {
        $landlord->update($request->all());

        return (new LandlordResource($landlord))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Landlord $landlord)
    {
        abort_if(Gate::denies('landlord_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landlord->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
