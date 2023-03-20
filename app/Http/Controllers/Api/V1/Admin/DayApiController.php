<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Models\Day;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Http\Resources\Admin\DayResource;
use Symfony\Component\HttpFoundation\Response;

class DayApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('day_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DayResource(Day::all());
    }

    public function store(StoreDayRequest $request)
    {
        $day = Day::create($request->all());

        return (new DayResource($day))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Day $day)
    {
        abort_if(Gate::denies('day_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DayResource($day);
    }

    public function update(UpdateDayRequest $request, Day $day)
    {
        $day->update($request->all());

        return (new DayResource($day))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Day $day)
    {
        abort_if(Gate::denies('day_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $day->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
