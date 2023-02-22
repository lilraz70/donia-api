<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModelOfVehicleRequest;
use App\Http\Requests\UpdateModelOfVehicleRequest;
use App\Http\Resources\Admin\ModelOfVehicleResource;
use App\Models\ModelOfVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModelOfVehicleApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('model_of_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModelOfVehicleResource(ModelOfVehicle::with(['brand'])->get());
    }

    public function store(StoreModelOfVehicleRequest $request)
    {
        $modelOfVehicle = ModelOfVehicle::create($request->all());

        return (new ModelOfVehicleResource($modelOfVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ModelOfVehicle $modelOfVehicle)
    {
        abort_if(Gate::denies('model_of_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ModelOfVehicleResource($modelOfVehicle->load(['brand']));
    }

    public function update(UpdateModelOfVehicleRequest $request, ModelOfVehicle $modelOfVehicle)
    {
        $modelOfVehicle->update($request->all());

        return (new ModelOfVehicleResource($modelOfVehicle))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ModelOfVehicle $modelOfVehicle)
    {
        abort_if(Gate::denies('model_of_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modelOfVehicle->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
