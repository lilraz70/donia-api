<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorTypeRequest;
use App\Http\Requests\UpdateColorTypeRequest;
use App\Http\Resources\Admin\ColorTypeResource;
use App\Models\ColorType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColorTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('color_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColorTypeResource(ColorType::all());
    }

    public function store(StoreColorTypeRequest $request)
    {
        $colorType = ColorType::create($request->all());

        return (new ColorTypeResource($colorType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ColorType $colorType)
    {
        abort_if(Gate::denies('color_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColorTypeResource($colorType);
    }

    public function update(UpdateColorTypeRequest $request, ColorType $colorType)
    {
        $colorType->update($request->all());

        return (new ColorTypeResource($colorType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ColorType $colorType)
    {
        abort_if(Gate::denies('color_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colorType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
