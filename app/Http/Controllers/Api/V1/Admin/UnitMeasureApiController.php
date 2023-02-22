<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUnitMeasureRequest;
use App\Http\Requests\UpdateUnitMeasureRequest;
use App\Http\Resources\Admin\UnitMeasureResource;
use App\Models\UnitMeasure;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UnitMeasureApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('unit_measure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UnitMeasureResource(UnitMeasure::all());
    }

    public function store(StoreUnitMeasureRequest $request)
    {
        $unitMeasure = UnitMeasure::create($request->all());

        return (new UnitMeasureResource($unitMeasure))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UnitMeasure $unitMeasure)
    {
        abort_if(Gate::denies('unit_measure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UnitMeasureResource($unitMeasure);
    }

    public function update(UpdateUnitMeasureRequest $request, UnitMeasure $unitMeasure)
    {
        $unitMeasure->update($request->all());

        return (new UnitMeasureResource($unitMeasure))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UnitMeasure $unitMeasure)
    {
        abort_if(Gate::denies('unit_measure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitMeasure->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
