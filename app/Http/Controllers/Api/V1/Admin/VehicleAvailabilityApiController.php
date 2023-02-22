<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleAvailabilityRequest;
use App\Http\Requests\UpdateVehicleAvailabilityRequest;
use App\Http\Resources\Admin\VehicleAvailabilityResource;
use App\Models\VehicleAvailability;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleAvailabilityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vehicle_availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleAvailabilityResource(VehicleAvailability::with(['sellrentcar'])->get());
    }

    public function store(StoreVehicleAvailabilityRequest $request)
    {
        $vehicleAvailability = VehicleAvailability::create($request->all());

        return (new VehicleAvailabilityResource($vehicleAvailability))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VehicleAvailability $vehicleAvailability)
    {
        abort_if(Gate::denies('vehicle_availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VehicleAvailabilityResource($vehicleAvailability->load(['sellrentcar']));
    }

    public function update(UpdateVehicleAvailabilityRequest $request, VehicleAvailability $vehicleAvailability)
    {
        $vehicleAvailability->update($request->all());

        return (new VehicleAvailabilityResource($vehicleAvailability))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VehicleAvailability $vehicleAvailability)
    {
        abort_if(Gate::denies('vehicle_availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleAvailability->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
