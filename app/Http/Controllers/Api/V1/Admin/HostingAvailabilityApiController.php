<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHostingAvailabilityRequest;
use App\Http\Requests\UpdateHostingAvailabilityRequest;
use App\Http\Resources\Admin\HostingAvailabilityResource;
use App\Models\HostingAvailability;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HostingAvailabilityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hosting_availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingAvailabilityResource(HostingAvailability::with(['lodging'])->get());
    }

    public function store(StoreHostingAvailabilityRequest $request)
    {
        $hostingAvailability = HostingAvailability::create($request->all());

        return (new HostingAvailabilityResource($hostingAvailability))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(HostingAvailability $hostingAvailability)
    {
        abort_if(Gate::denies('hosting_availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingAvailabilityResource($hostingAvailability->load(['lodging']));
    }

    public function update(UpdateHostingAvailabilityRequest $request, HostingAvailability $hostingAvailability)
    {
        $hostingAvailability->update($request->all());

        return (new HostingAvailabilityResource($hostingAvailability))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(HostingAvailability $hostingAvailability)
    {
        abort_if(Gate::denies('hosting_availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingAvailability->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
