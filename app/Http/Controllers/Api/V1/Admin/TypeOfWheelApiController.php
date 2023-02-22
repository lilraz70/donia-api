<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfWheelRequest;
use App\Http\Requests\UpdateTypeOfWheelRequest;
use App\Http\Resources\Admin\TypeOfWheelResource;
use App\Models\TypeOfWheel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfWheelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_of_wheel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfWheelResource(TypeOfWheel::all());
    }

    public function store(StoreTypeOfWheelRequest $request)
    {
        $typeOfWheel = TypeOfWheel::create($request->all());

        return (new TypeOfWheelResource($typeOfWheel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeOfWheel $typeOfWheel)
    {
        abort_if(Gate::denies('type_of_wheel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfWheelResource($typeOfWheel);
    }

    public function update(UpdateTypeOfWheelRequest $request, TypeOfWheel $typeOfWheel)
    {
        $typeOfWheel->update($request->all());

        return (new TypeOfWheelResource($typeOfWheel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeOfWheel $typeOfWheel)
    {
        abort_if(Gate::denies('type_of_wheel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfWheel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
