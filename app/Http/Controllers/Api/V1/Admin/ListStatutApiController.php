<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreListStatutRequest;
use App\Http\Requests\UpdateListStatutRequest;
use App\Http\Resources\Admin\ListStatutResource;
use App\Models\ListStatut;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListStatutApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('list_statut_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ListStatutResource(ListStatut::with(['objecttype'])->get());
    }

    public function store(StoreListStatutRequest $request)
    {
        $listStatut = ListStatut::create($request->all());

        return (new ListStatutResource($listStatut))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ListStatut $listStatut)
    {
        abort_if(Gate::denies('list_statut_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ListStatutResource($listStatut->load(['objecttype']));
    }

    public function update(UpdateListStatutRequest $request, ListStatut $listStatut)
    {
        $listStatut->update($request->all());

        return (new ListStatutResource($listStatut))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ListStatut $listStatut)
    {
        abort_if(Gate::denies('list_statut_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listStatut->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
