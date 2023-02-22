<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReasonRequest;
use App\Http\Requests\UpdateReasonRequest;
use App\Http\Resources\Admin\ReasonResource;
use App\Models\Reason;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReasonApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('reason_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReasonResource(Reason::all());
    }

    public function store(StoreReasonRequest $request)
    {
        $reason = Reason::create($request->all());

        return (new ReasonResource($reason))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Reason $reason)
    {
        abort_if(Gate::denies('reason_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ReasonResource($reason);
    }

    public function update(UpdateReasonRequest $request, Reason $reason)
    {
        $reason->update($request->all());

        return (new ReasonResource($reason))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Reason $reason)
    {
        abort_if(Gate::denies('reason_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reason->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
