<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserserviceRequest;
use App\Http\Requests\UpdateUserserviceRequest;
use App\Http\Resources\Admin\UserserviceResource;
use App\Models\Userservice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserservicesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('userservice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserserviceResource(Userservice::with(['user', 'areasofservice'])->get());
    }

    public function store(StoreUserserviceRequest $request)
    {
        $userservice = Userservice::create($request->all());

        return (new UserserviceResource($userservice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Userservice $userservice)
    {
        abort_if(Gate::denies('userservice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserserviceResource($userservice->load(['user', 'areasofservice']));
    }

    public function update(UpdateUserserviceRequest $request, Userservice $userservice)
    {
        $userservice->update($request->all());

        return (new UserserviceResource($userservice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Userservice $userservice)
    {
        abort_if(Gate::denies('userservice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userservice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
