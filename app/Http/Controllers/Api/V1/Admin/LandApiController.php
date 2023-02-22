<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandRequest;
use App\Http\Requests\UpdateLandRequest;
use App\Http\Resources\Admin\LandResource;
use App\Models\Land;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('land_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandResource(Land::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory'])->get());
    }

    public function store(StoreLandRequest $request)
    {
        $land = Land::create($request->all());

        return (new LandResource($land))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Land $land)
    {
        abort_if(Gate::denies('land_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandResource($land->load(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory']));
    }

    public function update(UpdateLandRequest $request, Land $land)
    {
        $land->update($request->all());

        return (new LandResource($land))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Land $land)
    {
        abort_if(Gate::denies('land_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $land->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
