<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarpoolingVehicleRequest;
use App\Http\Requests\UpdateCarpoolingVehicleRequest;
use App\Http\Resources\Admin\CarpoolingVehicleResource;
use App\Models\CarpoolingVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarpoolingVehicleApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpooling_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarpoolingVehicleResource(CarpoolingVehicle::with(['brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeofutility'])->get());
    }

    public function store(StoreCarpoolingVehicleRequest $request)
    {
        $carpoolingVehicle = CarpoolingVehicle::create($request->all());

        return (new CarpoolingVehicleResource($carpoolingVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CarpoolingVehicle $carpoolingVehicle)
    {
        abort_if(Gate::denies('carpooling_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarpoolingVehicleResource($carpoolingVehicle->load(['brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeofutility']));
    }

    public function update(UpdateCarpoolingVehicleRequest $request, CarpoolingVehicle $carpoolingVehicle)
    {
        $carpoolingVehicle->update($request->all());

        return (new CarpoolingVehicleResource($carpoolingVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CarpoolingVehicle $carpoolingVehicle)
    {
        abort_if(Gate::denies('carpooling_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpoolingVehicle->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
