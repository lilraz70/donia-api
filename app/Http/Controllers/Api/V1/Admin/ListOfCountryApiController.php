<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreListOfCountryRequest;
use App\Http\Requests\UpdateListOfCountryRequest;
use App\Http\Resources\Admin\ListOfCountryResource;
use App\Models\ListOfCountry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListOfCountryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('list_of_country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ListOfCountryResource(ListOfCountry::all());
    }

    public function store(StoreListOfCountryRequest $request)
    {
        $listOfCountry = ListOfCountry::create($request->all());

        return (new ListOfCountryResource($listOfCountry))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ListOfCountry $listOfCountry)
    {
        abort_if(Gate::denies('list_of_country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ListOfCountryResource($listOfCountry);
    }

    public function update(UpdateListOfCountryRequest $request, ListOfCountry $listOfCountry)
    {
        $listOfCountry->update($request->all());

        return (new ListOfCountryResource($listOfCountry))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ListOfCountry $listOfCountry)
    {
        abort_if(Gate::denies('list_of_country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listOfCountry->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
