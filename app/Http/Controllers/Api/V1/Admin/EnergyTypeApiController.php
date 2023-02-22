<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnergyTypeRequest;
use App\Http\Requests\UpdateEnergyTypeRequest;
use App\Http\Resources\Admin\EnergyTypeResource;
use App\Models\EnergyType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnergyTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('energy_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EnergyTypeResource(EnergyType::all());
    }

    public function store(StoreEnergyTypeRequest $request)
    {
        $energyType = EnergyType::create($request->all());

        return (new EnergyTypeResource($energyType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EnergyType $energyType)
    {
        abort_if(Gate::denies('energy_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EnergyTypeResource($energyType);
    }

    public function update(UpdateEnergyTypeRequest $request, EnergyType $energyType)
    {
        $energyType->update($request->all());

        return (new EnergyTypeResource($energyType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EnergyType $energyType)
    {
        abort_if(Gate::denies('energy_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $energyType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
