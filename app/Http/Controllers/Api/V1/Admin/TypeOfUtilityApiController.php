<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfUtilityRequest;
use App\Http\Requests\UpdateTypeOfUtilityRequest;
use App\Http\Resources\Admin\TypeOfUtilityResource;
use App\Models\TypeOfUtility;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfUtilityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_of_utility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfUtilityResource(TypeOfUtility::all());
    }

    public function store(StoreTypeOfUtilityRequest $request)
    {
        $typeOfUtility = TypeOfUtility::create($request->all());

        return (new TypeOfUtilityResource($typeOfUtility))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeOfUtility $typeOfUtility)
    {
        abort_if(Gate::denies('type_of_utility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfUtilityResource($typeOfUtility);
    }

    public function update(UpdateTypeOfUtilityRequest $request, TypeOfUtility $typeOfUtility)
    {
        $typeOfUtility->update($request->all());

        return (new TypeOfUtilityResource($typeOfUtility))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeOfUtility $typeOfUtility)
    {
        abort_if(Gate::denies('type_of_utility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfUtility->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
