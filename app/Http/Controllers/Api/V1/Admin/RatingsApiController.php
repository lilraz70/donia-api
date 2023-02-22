<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Http\Resources\Admin\RatingResource;
use App\Models\Rating;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RatingsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RatingResource(Rating::with(['areasofservices', 'objecttype', 'user', 'ratingtype'])->get());
    }

    public function store(StoreRatingRequest $request)
    {
        $rating = Rating::create($request->all());

        return (new RatingResource($rating))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Rating $rating)
    {
        abort_if(Gate::denies('rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RatingResource($rating->load(['areasofservices', 'objecttype', 'user', 'ratingtype']));
    }

    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $rating->update($request->all());

        return (new RatingResource($rating))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Rating $rating)
    {
        abort_if(Gate::denies('rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rating->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
