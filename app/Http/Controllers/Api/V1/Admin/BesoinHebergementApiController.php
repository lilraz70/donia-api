<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBesoinHebergementRequest;
use App\Http\Requests\UpdateBesoinHebergementRequest;
use App\Http\Resources\Admin\BesoinHebergementResource;
use App\Models\BesoinHebergement;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BesoinHebergementApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('besoin_hebergement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BesoinHebergementResource(BesoinHebergement::with(['hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel'])->get());
    }

    public function store(StoreBesoinHebergementRequest $request)
    {
        $besoinHebergement = BesoinHebergement::create($request->all());

        return (new BesoinHebergementResource($besoinHebergement))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BesoinHebergement $besoinHebergement)
    {
        abort_if(Gate::denies('besoin_hebergement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BesoinHebergementResource($besoinHebergement->load(['hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel']));
    }

    public function update(UpdateBesoinHebergementRequest $request, BesoinHebergement $besoinHebergement)
    {
        $besoinHebergement->update($request->all());

        return (new BesoinHebergementResource($besoinHebergement))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BesoinHebergement $besoinHebergement)
    {
        abort_if(Gate::denies('besoin_hebergement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $besoinHebergement->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
