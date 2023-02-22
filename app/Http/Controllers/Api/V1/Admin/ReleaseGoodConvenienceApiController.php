<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReleaseGoodConvenienceRequest;
use App\Http\Requests\UpdateReleaseGoodConvenienceRequest;
use App\Http\Resources\Admin\ReleaseGoodConvenienceResource;
use App\Models\ReleaseGoodConvenience;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReleaseGoodConvenienceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('release_good_convenience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReleaseGoodConvenienceResource(ReleaseGoodConvenience::with(['releasegood', 'conveniencetype'])->get());
    }

    public function store(StoreReleaseGoodConvenienceRequest $request)
    {
        $releaseGoodConvenience = ReleaseGoodConvenience::create($request->all());

        return (new ReleaseGoodConvenienceResource($releaseGoodConvenience))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ReleaseGoodConvenience $releaseGoodConvenience)
    {
        abort_if(Gate::denies('release_good_convenience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReleaseGoodConvenienceResource($releaseGoodConvenience->load(['releasegood', 'conveniencetype']));
    }

    public function update(UpdateReleaseGoodConvenienceRequest $request, ReleaseGoodConvenience $releaseGoodConvenience)
    {
    try{
        $releaseGoodConvenience->update($request->all());

        return (new ReleaseGoodConvenienceResource($releaseGoodConvenience))->response();
      }catch(\Exception $e){
                  return $e;
                      }
    }

    public function destroy(ReleaseGoodConvenience $releaseGoodConvenience)
    {
        abort_if(Gate::denies('release_good_convenience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releaseGoodConvenience->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
