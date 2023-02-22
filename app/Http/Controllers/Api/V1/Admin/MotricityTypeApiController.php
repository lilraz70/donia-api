<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMotricityTypeRequest;
use App\Http\Requests\UpdateMotricityTypeRequest;
use App\Http\Resources\Admin\MotricityTypeResource;
use App\Models\MotricityType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MotricityTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('motricity_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MotricityTypeResource(MotricityType::all());
    }

    public function store(StoreMotricityTypeRequest $request)
    {
        $motricityType = MotricityType::create($request->all());

        return (new MotricityTypeResource($motricityType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MotricityType $motricityType)
    {
        abort_if(Gate::denies('motricity_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MotricityTypeResource($motricityType);
    }

    public function update(UpdateMotricityTypeRequest $request, MotricityType $motricityType)
    {
        $motricityType->update($request->all());

        return (new MotricityTypeResource($motricityType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MotricityType $motricityType)
    {
        abort_if(Gate::denies('motricity_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motricityType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
