<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNeedVehicleRequest;
use App\Http\Requests\UpdateNeedVehicleRequest;
use App\Http\Resources\Admin\NeedVehicleResource;
use App\Models\NeedVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NeedVehicleApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('need_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NeedVehicleResource(NeedVehicle::with(['brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer', 'emergencylevel'])->get());
    }

    public function store(StoreNeedVehicleRequest $request)
    {
        $needVehicle = NeedVehicle::create($request->all());

        return (new NeedVehicleResource($needVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(NeedVehicle $needVehicle)
    {
        abort_if(Gate::denies('need_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new NeedVehicleResource($needVehicle->load(['brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer', 'emergencylevel']));
    }

    public function update(UpdateNeedVehicleRequest $request, NeedVehicle $needVehicle)
    {
        $needVehicle->update($request->all());

        return (new NeedVehicleResource($needVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(NeedVehicle $needVehicle)
    {
        abort_if(Gate::denies('need_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $needVehicle->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
