<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfHouseRequest;
use App\Http\Requests\UpdateTypeOfHouseRequest;
use App\Http\Resources\Admin\TypeOfHouseResource;
use App\Models\TypeOfHouse;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfHouseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_of_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfHouseResource(TypeOfHouse::all());
    }

    public function store(StoreTypeOfHouseRequest $request)
    {
        $typeOfHouse = TypeOfHouse::create($request->all());

        return (new TypeOfHouseResource($typeOfHouse))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeOfHouse $typeOfHouse)
    {
        abort_if(Gate::denies('type_of_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfHouseResource($typeOfHouse);
    }

    public function update(UpdateTypeOfHouseRequest $request, TypeOfHouse $typeOfHouse)
    {
        $typeOfHouse->update($request->all());

        return (new TypeOfHouseResource($typeOfHouse))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeOfHouse $typeOfHouse)
    {
        abort_if(Gate::denies('type_of_house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfHouse->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
