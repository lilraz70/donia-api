<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfMediumRequest;
use App\Http\Requests\UpdateTypeOfMediumRequest;
use App\Http\Resources\Admin\TypeOfMediumResource;
use App\Models\TypeOfMedium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfMediaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_of_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfMediumResource(TypeOfMedium::all());
    }

    public function store(StoreTypeOfMediumRequest $request)
    {
        $typeOfMedium = TypeOfMedium::create($request->all());

        return (new TypeOfMediumResource($typeOfMedium))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeOfMedium $typeOfMedium)
    {
        abort_if(Gate::denies('type_of_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfMediumResource($typeOfMedium);
    }

    public function update(UpdateTypeOfMediumRequest $request, TypeOfMedium $typeOfMedium)
    {
        $typeOfMedium->update($request->all());

        return (new TypeOfMediumResource($typeOfMedium))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeOfMedium $typeOfMedium)
    {
        abort_if(Gate::denies('type_of_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfMedium->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
