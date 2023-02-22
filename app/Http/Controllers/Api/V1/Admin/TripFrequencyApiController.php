<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripFrequencyRequest;
use App\Http\Requests\UpdateTripFrequencyRequest;
use App\Http\Resources\Admin\TripFrequencyResource;
use App\Models\TripFrequency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripFrequencyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('trip_frequency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TripFrequencyResource(TripFrequency::with(['day', 'trip'])->get());
    }

    public function store(StoreTripFrequencyRequest $request)
    {
        $tripFrequency = TripFrequency::create($request->all());

        return (new TripFrequencyResource($tripFrequency))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TripFrequency $tripFrequency)
    {
        abort_if(Gate::denies('trip_frequency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TripFrequencyResource($tripFrequency->load(['day', 'trip']));
    }

    public function update(UpdateTripFrequencyRequest $request, TripFrequency $tripFrequency)
    {
        $tripFrequency->update($request->all());

        return (new TripFrequencyResource($tripFrequency))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TripFrequency $tripFrequency)
    {
        abort_if(Gate::denies('trip_frequency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tripFrequency->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
