<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLodgingRequest;
use App\Http\Requests\UpdateLodgingRequest;
use App\Http\Resources\Admin\LodgingResource;
use App\Models\Lodging;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LodgingApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lodging_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LodgingResource(Lodging::with(['hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut'])->get());
    }

    public function store(StoreLodgingRequest $request)
    {
        $lodging = Lodging::create($request->all());

        return (new LodgingResource($lodging))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Lodging $lodging)
    {
        abort_if(Gate::denies('lodging_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LodgingResource($lodging->load(['hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut']));
    }

    public function update(UpdateLodgingRequest $request, Lodging $lodging)
    {
        $lodging->update($request->all());

        return (new LodgingResource($lodging))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Lodging $lodging)
    {
        abort_if(Gate::denies('lodging_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodging->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
