<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcceptCguRequest;
use App\Http\Requests\UpdateAcceptCguRequest;
use App\Http\Resources\Admin\AcceptCguResource;
use App\Models\AcceptCgu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcceptCguApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('accept_cgu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AcceptCguResource(AcceptCgu::with(['user'])->get());
    }

    public function store(StoreAcceptCguRequest $request)
    {
        $acceptCgu = AcceptCgu::create($request->all());

        return (new AcceptCguResource($acceptCgu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AcceptCgu $acceptCgu)
    {
        abort_if(Gate::denies('accept_cgu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AcceptCguResource($acceptCgu->load(['user']));
    }

    public function update(UpdateAcceptCguRequest $request, AcceptCgu $acceptCgu)
    {
        $acceptCgu->update($request->all());

        return (new AcceptCguResource($acceptCgu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AcceptCgu $acceptCgu)
    {
        abort_if(Gate::denies('accept_cgu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $acceptCgu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
