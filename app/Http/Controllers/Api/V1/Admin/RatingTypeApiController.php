<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingTypeRequest;
use App\Http\Requests\UpdateRatingTypeRequest;
use App\Http\Resources\Admin\RatingTypeResource;
use App\Models\RatingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingTypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rating_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RatingTypeResource(RatingType::all());
    }

    public function store(StoreRatingTypeRequest $request)
    {
        $ratingType = RatingType::create($request->all());

        return (new RatingTypeResource($ratingType))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(RatingType $ratingType)
    {
        abort_if(Gate::denies('rating_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RatingTypeResource($ratingType);
    }

    public function update(UpdateRatingTypeRequest $request, RatingType $ratingType)
    {
        $ratingType->update($request->all());

        return (new RatingTypeResource($ratingType))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(RatingType $ratingType)
    {
        abort_if(Gate::denies('rating_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ratingType->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
