<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRimTypeRequest;
use App\Http\Requests\UpdateRimTypeRequest;
use App\Http\Resources\Admin\RimTypeResource;
use App\Models\RimType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RimTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rim_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RimTypeResource(RimType::all());
    }

    public function store(StoreRimTypeRequest $request)
    {
        $rimType = RimType::create($request->all());

        return (new RimTypeResource($rimType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RimType $rimType)
    {
        abort_if(Gate::denies('rim_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RimTypeResource($rimType);
    }

    public function update(UpdateRimTypeRequest $request, RimType $rimType)
    {
        $rimType->update($request->all());

        return (new RimTypeResource($rimType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RimType $rimType)
    {
        abort_if(Gate::denies('rim_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rimType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
