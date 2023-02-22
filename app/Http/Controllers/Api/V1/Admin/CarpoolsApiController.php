<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarpoolRequest;
use App\Http\Requests\UpdateCarpoolRequest;
use App\Http\Resources\Admin\CarpoolResource;
use App\Models\Carpool;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarpoolsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpool_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarpoolResource(Carpool::with(['user_client', 'user_fournisseur', 'paymentmode', 'trip', 'liststatut', 'carpoolingvehicle'])->get());
    }

    public function store(StoreCarpoolRequest $request)
    {
        $carpool = Carpool::create($request->all());

        return (new CarpoolResource($carpool))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Carpool $carpool)
    {
        abort_if(Gate::denies('carpool_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CarpoolResource($carpool->load(['user_client', 'user_fournisseur', 'paymentmode', 'trip', 'liststatut', 'carpoolingvehicle']));
    }

    public function update(UpdateCarpoolRequest $request, Carpool $carpool)
    {
        $carpool->update($request->all());

        return (new CarpoolResource($carpool))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Carpool $carpool)
    {
        abort_if(Gate::denies('carpool_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpool->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
