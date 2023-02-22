<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHostingServiceRequest;
use App\Http\Requests\UpdateHostingServiceRequest;
use App\Http\Resources\Admin\HostingServiceResource;
use App\Models\HostingService;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HostingServicesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hosting_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingServiceResource(HostingService::with(['lodging', 'servicesinclus'])->get());
    }

    public function store(StoreHostingServiceRequest $request)
    {
        $hostingService = HostingService::create($request->all());

        return (new HostingServiceResource($hostingService))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HostingService $hostingService)
    {
        abort_if(Gate::denies('hosting_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingServiceResource($hostingService->load(['lodging', 'servicesinclus']));
    }

    public function update(UpdateHostingServiceRequest $request, HostingService $hostingService)
    {
        $hostingService->update($request->all());

        return (new HostingServiceResource($hostingService))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HostingService $hostingService)
    {
        abort_if(Gate::denies('hosting_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingService->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
