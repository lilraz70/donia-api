<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSetCountryRequest;
use App\Http\Requests\UpdateSetCountryRequest;
use App\Http\Resources\Admin\SetCountryResource;
use App\Models\SetCountry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCountryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('set_country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SetCountryResource(SetCountry::all());
    }

    public function store(StoreSetCountryRequest $request)
    {
        $setCountry = SetCountry::create($request->all());

        return (new SetCountryResource($setCountry))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SetCountry $setCountry)
    {
        abort_if(Gate::denies('set_country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SetCountryResource($setCountry);
    }

    public function update(UpdateSetCountryRequest $request, SetCountry $setCountry)
    {
        $setCountry->update($request->all());

        return (new SetCountryResource($setCountry))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SetCountry $setCountry)
    {
        abort_if(Gate::denies('set_country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setCountry->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
