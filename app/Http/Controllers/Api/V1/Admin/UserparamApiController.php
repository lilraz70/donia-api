<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserparamRequest;
use App\Http\Requests\UpdateUserparamRequest;
use App\Http\Resources\Admin\UserparamResource;
use App\Models\Userparam;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserparamApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('userparam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserparamResource(Userparam::with(['user', 'parameterusertype'])->get());
    }

    public function store(StoreUserparamRequest $request)
    {
        $userparam = Userparam::create($request->all());

        return (new UserparamResource($userparam))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Userparam $userparam)
    {
        abort_if(Gate::denies('userparam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserparamResource($userparam->load(['user', 'parameterusertype']));
    }

    public function update(UpdateUserparamRequest $request, Userparam $userparam)
    {
        $userparam->update($request->all());

        return (new UserparamResource($userparam))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Userparam $userparam)
    {
        abort_if(Gate::denies('userparam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userparam->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
