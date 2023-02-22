<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocalRequest;
use App\Http\Requests\UpdateLocalRequest;
use App\Http\Resources\Admin\LocalResource;
use App\Models\Local;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('local_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalResource(Local::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut'])->get());
    }

    public function store(StoreLocalRequest $request)
    {
        $local = Local::create($request->all());

        return (new LocalResource($local))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Local $local)
    {
        abort_if(Gate::denies('local_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LocalResource($local->load(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut']));
    }

    public function update(UpdateLocalRequest $request, Local $local)
    {
        $local->update($request->all());

        return (new LocalResource($local))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Local $local)
    {
        abort_if(Gate::denies('local_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
