<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHostingspecRequest;
use App\Http\Requests\UpdateHostingspecRequest;
use App\Http\Resources\Admin\HostingspecResource;
use App\Models\Hostingspec;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HostingspecApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hostingspec_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingspecResource(Hostingspec::with(['lodging', 'conveniencetype'])->get());
    }

    public function store(StoreHostingspecRequest $request)
    {
        $hostingspec = Hostingspec::create($request->all());

        return (new HostingspecResource($hostingspec))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Hostingspec $hostingspec)
    {
        abort_if(Gate::denies('hostingspec_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HostingspecResource($hostingspec->load(['lodging', 'conveniencetype']));
    }

    public function update(UpdateHostingspecRequest $request, Hostingspec $hostingspec)
    {
        $hostingspec->update($request->all());

        return (new HostingspecResource($hostingspec))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Hostingspec $hostingspec)
    {
        abort_if(Gate::denies('hostingspec_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingspec->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
