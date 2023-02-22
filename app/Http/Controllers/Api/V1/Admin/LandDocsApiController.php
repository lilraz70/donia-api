<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandDocRequest;
use App\Http\Requests\UpdateLandDocRequest;
use App\Http\Resources\Admin\LandDocResource;
use App\Models\LandDoc;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandDocsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('land_doc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandDocResource(LandDoc::with(['land', 'typeadmdoc'])->get());
    }

    public function store(StoreLandDocRequest $request)
    {
        $landDoc = LandDoc::create($request->all());

        return (new LandDocResource($landDoc))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LandDoc $landDoc)
    {
        abort_if(Gate::denies('land_doc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandDocResource($landDoc->load(['land', 'typeadmdoc']));
    }

    public function update(UpdateLandDocRequest $request, LandDoc $landDoc)
    {
        $landDoc->update($request->all());

        return (new LandDocResource($landDoc))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LandDoc $landDoc)
    {
        abort_if(Gate::denies('land_doc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landDoc->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
