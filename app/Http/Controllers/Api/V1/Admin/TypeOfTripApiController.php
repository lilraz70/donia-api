<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfTripRequest;
use App\Http\Requests\UpdateTypeOfTripRequest;
use App\Http\Resources\Admin\TypeOfTripResource;
use App\Models\TypeOfTrip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfTripApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_of_trip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfTripResource(TypeOfTrip::all());
    }

    public function store(StoreTypeOfTripRequest $request)
    {
        $typeOfTrip = TypeOfTrip::create($request->all());

        return (new TypeOfTripResource($typeOfTrip))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeOfTrip $typeOfTrip)
    {
        abort_if(Gate::denies('type_of_trip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfTripResource($typeOfTrip);
    }

    public function update(UpdateTypeOfTripRequest $request, TypeOfTrip $typeOfTrip)
    {
        $typeOfTrip->update($request->all());

        return (new TypeOfTripResource($typeOfTrip))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeOfTrip $typeOfTrip)
    {
        abort_if(Gate::denies('type_of_trip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfTrip->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
