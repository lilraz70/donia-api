<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAreasOfServiceRequest;
use App\Http\Requests\UpdateAreasOfServiceRequest;
use App\Http\Resources\Admin\AreasOfServiceResource;
use App\Models\AreasOfService;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AreasOfServiceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('areas_of_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AreasOfServiceResource(AreasOfService::all());
    }

    public function store(StoreAreasOfServiceRequest $request)
    {
        $areasOfService = AreasOfService::create($request->all());

        return (new AreasOfServiceResource($areasOfService))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AreasOfService $areasOfService)
    {
        abort_if(Gate::denies('areas_of_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AreasOfServiceResource($areasOfService);
    }

    public function update(UpdateAreasOfServiceRequest $request, AreasOfService $areasOfService)
    {
        $areasOfService->update($request->all());

        return (new AreasOfServiceResource($areasOfService))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AreasOfService $areasOfService)
    {
        abort_if(Gate::denies('areas_of_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areasOfService->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
