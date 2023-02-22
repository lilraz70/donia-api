<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServicesincluRequest;
use App\Http\Requests\UpdateServicesincluRequest;
use App\Http\Resources\Admin\ServicesincluResource;
use App\Models\Servicesinclu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesinclusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('servicesinclu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServicesincluResource(Servicesinclu::all());
    }

    public function store(StoreServicesincluRequest $request)
    {
        $servicesinclu = Servicesinclu::create($request->all());

        return (new ServicesincluResource($servicesinclu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Servicesinclu $servicesinclu)
    {
        abort_if(Gate::denies('servicesinclu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServicesincluResource($servicesinclu);
    }

    public function update(UpdateServicesincluRequest $request, Servicesinclu $servicesinclu)
    {
        $servicesinclu->update($request->all());

        return (new ServicesincluResource($servicesinclu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Servicesinclu $servicesinclu)
    {
        abort_if(Gate::denies('servicesinclu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicesinclu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
