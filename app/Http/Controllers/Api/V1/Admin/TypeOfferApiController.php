<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeOfferRequest;
use App\Http\Requests\UpdateTypeOfferRequest;
use App\Http\Resources\Admin\TypeOfferResource;
use App\Models\TypeOffer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeOfferApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_offer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfferResource(TypeOffer::all());
    }

    public function store(StoreTypeOfferRequest $request)
    {
        $typeOffer = TypeOffer::create($request->all());

        return (new TypeOfferResource($typeOffer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TypeOffer $typeOffer)
    {
        abort_if(Gate::denies('type_offer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TypeOfferResource($typeOffer);
    }

    public function update(UpdateTypeOfferRequest $request, TypeOffer $typeOffer)
    {
        $typeOffer->update($request->all());

        return (new TypeOfferResource($typeOffer))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TypeOffer $typeOffer)
    {
        abort_if(Gate::denies('type_offer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOffer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
