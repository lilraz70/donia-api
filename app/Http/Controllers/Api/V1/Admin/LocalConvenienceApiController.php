<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocalConvenienceRequest;
use App\Http\Requests\UpdateLocalConvenienceRequest;
use App\Http\Resources\Admin\LocalConvenienceResource;
use App\Models\LocalConvenience;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalConvenienceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('local_convenience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalConvenienceResource(LocalConvenience::with(['local', 'conveniencetype'])->get());
    }

    public function store(StoreLocalConvenienceRequest $request)
    {
        $localConvenience = LocalConvenience::create($request->all());

        return (new LocalConvenienceResource($localConvenience))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LocalConvenience $localConvenience)
    {
        abort_if(Gate::denies('local_convenience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalConvenienceResource($localConvenience->load(['local', 'conveniencetype']));
    }

    public function update(UpdateLocalConvenienceRequest $request, LocalConvenience $localConvenience)
    {
        $localConvenience->update($request->all());

        return (new LocalConvenienceResource($localConvenience))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LocalConvenience $localConvenience)
    {
        abort_if(Gate::denies('local_convenience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localConvenience->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
