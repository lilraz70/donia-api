<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use App\Http\Resources\Admin\LicenseResource;
use App\Models\License;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LicenseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('license_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LicenseResource(License::with(['user'])->get());
    }

    public function store(StoreLicenseRequest $request)
    {
        $license = License::create($request->all());

        return (new LicenseResource($license))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(License $license)
    {
        abort_if(Gate::denies('license_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LicenseResource($license->load(['user']));
    }

    public function update(UpdateLicenseRequest $request, License $license)
    {
        $license->update($request->all());

        return (new LicenseResource($license))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(License $license)
    {
        abort_if(Gate::denies('license_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $license->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
