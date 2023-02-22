<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSignalerRequest;
use App\Http\Requests\UpdateSignalerRequest;
use App\Http\Resources\Admin\SignalerResource;
use App\Models\Signaler;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SignalerApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('signaler_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SignalerResource(Signaler::with(['user', 'objecttype', 'reason'])->get());
    }

    public function store(StoreSignalerRequest $request)
    {
        $signaler = Signaler::create($request->all());

        return (new SignalerResource($signaler))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Signaler $signaler)
    {
        abort_if(Gate::denies('signaler_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SignalerResource($signaler->load(['user', 'objecttype', 'reason']));
    }

    public function update(UpdateSignalerRequest $request, Signaler $signaler)
    {
        $signaler->update($request->all());

        return (new SignalerResource($signaler))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Signaler $signaler)
    {
        abort_if(Gate::denies('signaler_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signaler->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
