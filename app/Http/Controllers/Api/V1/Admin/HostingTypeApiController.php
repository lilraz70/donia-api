<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHostingTypeRequest;
use App\Http\Requests\UpdateHostingTypeRequest;
use App\Http\Resources\Admin\HostingTypeResource;
use App\Models\HostingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HostingTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hosting_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingTypeResource(HostingType::all());
    }

    public function store(StoreHostingTypeRequest $request)
    {
        $hostingType = HostingType::create($request->all());

        return (new HostingTypeResource($hostingType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HostingType $hostingType)
    {
        abort_if(Gate::denies('hosting_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingTypeResource($hostingType);
    }

    public function update(UpdateHostingTypeRequest $request, HostingType $hostingType)
    {
        $hostingType->update($request->all());

        return (new HostingTypeResource($hostingType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HostingType $hostingType)
    {
        abort_if(Gate::denies('hosting_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
