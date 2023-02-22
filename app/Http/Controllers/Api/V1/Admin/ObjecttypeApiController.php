<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObjecttypeRequest;
use App\Http\Requests\UpdateObjecttypeRequest;
use App\Http\Resources\Admin\ObjecttypeResource;
use App\Models\Objecttype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ObjecttypeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('objecttype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ObjecttypeResource(Objecttype::all());
    }

    public function store(StoreObjecttypeRequest $request)
    {
        $objecttype = Objecttype::create($request->all());

        return (new ObjecttypeResource($objecttype))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Objecttype $objecttype)
    {
        abort_if(Gate::denies('objecttype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ObjecttypeResource($objecttype);
    }

    public function update(UpdateObjecttypeRequest $request, Objecttype $objecttype)
    {
        $objecttype->update($request->all());

        return (new ObjecttypeResource($objecttype))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Objecttype $objecttype)
    {
        abort_if(Gate::denies('objecttype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttype->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
