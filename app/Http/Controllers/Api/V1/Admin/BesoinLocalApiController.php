<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBesoinLocalRequest;
use App\Http\Requests\UpdateBesoinLocalRequest;
use App\Http\Resources\Admin\BesoinLocalResource;
use App\Models\BesoinLocal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BesoinLocalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('besoin_local_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BesoinLocalResource(BesoinLocal::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'emergencylevel'])->get());
    }

    public function store(StoreBesoinLocalRequest $request)
    {
        $besoinLocal = BesoinLocal::create($request->all());

        return (new BesoinLocalResource($besoinLocal))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BesoinLocal $besoinLocal)
    {
        abort_if(Gate::denies('besoin_local_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BesoinLocalResource($besoinLocal->load(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'emergencylevel']));
    }

    public function update(UpdateBesoinLocalRequest $request, BesoinLocal $besoinLocal)
    {
        $besoinLocal->update($request->all());

        return (new BesoinLocalResource($besoinLocal))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BesoinLocal $besoinLocal)
    {
        abort_if(Gate::denies('besoin_local_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $besoinLocal->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
