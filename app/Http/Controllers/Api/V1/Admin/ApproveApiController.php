<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApproveRequest;
use App\Http\Requests\UpdateApproveRequest;
use App\Http\Resources\Admin\ApproveResource;
use App\Models\Approve;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApproveApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('approve_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApproveResource(Approve::with(['user', 'objecttype', 'reason'])->get());
    }

    public function store(StoreApproveRequest $request)
    {
        $approve = Approve::create($request->all());

        return (new ApproveResource($approve))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Approve $approve)
    {
        abort_if(Gate::denies('approve_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApproveResource($approve->load(['user', 'objecttype', 'reason']));
    }

    public function update(UpdateApproveRequest $request, Approve $approve)
    {
        $approve->update($request->all());

        return (new ApproveResource($approve))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Approve $approve)
    {
        abort_if(Gate::denies('approve_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approve->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
