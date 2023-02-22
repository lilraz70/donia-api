<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmergencyLevelRequest;
use App\Http\Requests\UpdateEmergencyLevelRequest;
use App\Http\Resources\Admin\EmergencyLevelResource;
use App\Models\EmergencyLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmergencyLevelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('emergency_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmergencyLevelResource(EmergencyLevel::all());
    }

    public function store(StoreEmergencyLevelRequest $request)
    {
        $emergencyLevel = EmergencyLevel::create($request->all());

        return (new EmergencyLevelResource($emergencyLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(EmergencyLevel $emergencyLevel)
    {
        abort_if(Gate::denies('emergency_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EmergencyLevelResource($emergencyLevel);
    }

    public function update(UpdateEmergencyLevelRequest $request, EmergencyLevel $emergencyLevel)
    {
        $emergencyLevel->update($request->all());

        return (new EmergencyLevelResource($emergencyLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(EmergencyLevel $emergencyLevel)
    {
        abort_if(Gate::denies('emergency_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emergencyLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
