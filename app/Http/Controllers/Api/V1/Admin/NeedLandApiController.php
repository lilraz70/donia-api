<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNeedLandRequest;
use App\Http\Requests\UpdateNeedLandRequest;
use App\Http\Resources\Admin\NeedLandResource;
use App\Models\NeedLand;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NeedLandApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('need_land_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NeedLandResource(NeedLand::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory', 'emergencylevel'])->get());
    }

    public function store(StoreNeedLandRequest $request)
    {
        $needLand = NeedLand::create($request->all());

        return (new NeedLandResource($needLand))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NeedLand $needLand)
    {
        abort_if(Gate::denies('need_land_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NeedLandResource($needLand->load(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory', 'emergencylevel']));
    }

    public function update(UpdateNeedLandRequest $request, NeedLand $needLand)
    {
        $needLand->update($request->all());

        return (new NeedLandResource($needLand))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NeedLand $needLand)
    {
        abort_if(Gate::denies('need_land_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $needLand->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
