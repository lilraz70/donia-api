<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConvenienceTypeRequest;
use App\Http\Requests\UpdateConvenienceTypeRequest;
use App\Http\Resources\Admin\ConvenienceTypeResource;
use App\Models\ConvenienceType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvenienceTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('convenience_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConvenienceTypeResource(ConvenienceType::all());
    }

    public function store(StoreConvenienceTypeRequest $request)
    {
        $convenienceType = ConvenienceType::create($request->all());

        return (new ConvenienceTypeResource($convenienceType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ConvenienceType $convenienceType)
    {
        abort_if(Gate::denies('convenience_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConvenienceTypeResource($convenienceType);
    }

    public function update(UpdateConvenienceTypeRequest $request, ConvenienceType $convenienceType)
    {
        $convenienceType->update($request->all());

        return (new ConvenienceTypeResource($convenienceType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ConvenienceType $convenienceType)
    {
        abort_if(Gate::denies('convenience_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $convenienceType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
