<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGearBoxRequest;
use App\Http\Requests\UpdateGearBoxRequest;
use App\Http\Resources\Admin\GearBoxResource;
use App\Models\GearBox;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GearBoxApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gear_box_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GearBoxResource(GearBox::all());
    }

    public function store(StoreGearBoxRequest $request)
    {
        $gearBox = GearBox::create($request->all());

        return (new GearBoxResource($gearBox))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(GearBox $gearBox)
    {
        abort_if(Gate::denies('gear_box_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new GearBoxResource($gearBox);
    }

    public function update(UpdateGearBoxRequest $request, GearBox $gearBox)
    {
        $gearBox->update($request->all());

        return (new GearBoxResource($gearBox))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(GearBox $gearBox)
    {
        abort_if(Gate::denies('gear_box_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gearBox->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
