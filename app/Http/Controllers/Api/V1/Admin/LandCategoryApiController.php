<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandCategoryRequest;
use App\Http\Requests\UpdateLandCategoryRequest;
use App\Http\Resources\Admin\LandCategoryResource;
use App\Models\LandCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LandCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('land_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandCategoryResource(LandCategory::all());
    }

    public function store(StoreLandCategoryRequest $request)
    {
        $landCategory = LandCategory::create($request->all());

        return (new LandCategoryResource($landCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LandCategory $landCategory)
    {
        abort_if(Gate::denies('land_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LandCategoryResource($landCategory);
    }

    public function update(UpdateLandCategoryRequest $request, LandCategory $landCategory)
    {
        $landCategory->update($request->all());

        return (new LandCategoryResource($landCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LandCategory $landCategory)
    {
        abort_if(Gate::denies('land_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
