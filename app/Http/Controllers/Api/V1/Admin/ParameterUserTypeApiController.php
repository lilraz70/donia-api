<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParameterUserTypeRequest;
use App\Http\Requests\UpdateParameterUserTypeRequest;
use App\Http\Resources\Admin\ParameterUserTypeResource;
use App\Models\ParameterUserType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParameterUserTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('parameter_user_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParameterUserTypeResource(ParameterUserType::all());
    }

    public function store(StoreParameterUserTypeRequest $request)
    {
        $parameterUserType = ParameterUserType::create($request->all());

        return (new ParameterUserTypeResource($parameterUserType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ParameterUserType $parameterUserType)
    {
        abort_if(Gate::denies('parameter_user_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ParameterUserTypeResource($parameterUserType);
    }

    public function update(UpdateParameterUserTypeRequest $request, ParameterUserType $parameterUserType)
    {
        $parameterUserType->update($request->all());

        return (new ParameterUserTypeResource($parameterUserType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ParameterUserType $parameterUserType)
    {
        abort_if(Gate::denies('parameter_user_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameterUserType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
