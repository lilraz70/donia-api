<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreAllmediaRequest;
use App\Http\Requests\UpdateAllmediaRequest;
use App\Http\Resources\Admin\AllmediaResource;
use App\Models\Allmedia;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllmediasApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('allmedia_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AllmediaResource(Allmedia::with(['objecttype', 'typeofmedia'])->get());
    }

    public function store(StoreAllmediaRequest $request)
    {
        $allmedia = Allmedia::create($request->all());

        if ($request->input('lien_ressources', false)) {
            $allmedia->addMedia(storage_path('tmp/uploads/' . basename($request->input('lien_ressources'))))->toMediaCollection('lien_ressources');
        }

        return (new AllmediaResource($allmedia))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Allmedia $allmedia)
    {
        abort_if(Gate::denies('allmedia_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AllmediaResource($allmedia->load(['objecttype', 'typeofmedia']));
    }

    public function update(UpdateAllmediaRequest $request, Allmedia $allmedia)
    {
        $allmedia->update($request->all());

        if ($request->input('lien_ressources', false)) {
            if (!$allmedia->lien_ressources || $request->input('lien_ressources') !== $allmedia->lien_ressources->file_name) {
                if ($allmedia->lien_ressources) {
                    $allmedia->lien_ressources->delete();
                }
                $allmedia->addMedia(storage_path('tmp/uploads/' . basename($request->input('lien_ressources'))))->toMediaCollection('lien_ressources');
            }
        } elseif ($allmedia->lien_ressources) {
            $allmedia->lien_ressources->delete();
        }

        return (new AllmediaResource($allmedia))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Allmedia $allmedia)
    {
        abort_if(Gate::denies('allmedia_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allmedia->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
