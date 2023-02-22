<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSellRentCarRequest;
use App\Http\Requests\UpdateSellRentCarRequest;
use App\Http\Resources\Admin\SellRentCarResource;
use App\Models\SellRentCar;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellRentCarApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sell_rent_car_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SellRentCarResource(SellRentCar::with(['brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer'])->get());
    }

    public function store(StoreSellRentCarRequest $request)
    {
        $sellRentCar = SellRentCar::create($request->all());

        return (new SellRentCarResource($sellRentCar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SellRentCar $sellRentCar)
    {
        abort_if(Gate::denies('sell_rent_car_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SellRentCarResource($sellRentCar->load(['brand', 'modelofvehicle', 'colortype', 'energytype', 'gearbox', 'vehicletype', 'typeofutility', 'motricitytype', 'typeofwheel', 'rimtype', 'listofcountry', 'user', 'liststatut', 'typeoffer']));
    }

    public function update(UpdateSellRentCarRequest $request, SellRentCar $sellRentCar)
    {
        $sellRentCar->update($request->all());

        return (new SellRentCarResource($sellRentCar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SellRentCar $sellRentCar)
    {
        abort_if(Gate::denies('sell_rent_car_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sellRentCar->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
