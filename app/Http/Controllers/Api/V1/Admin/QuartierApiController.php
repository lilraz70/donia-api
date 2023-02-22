<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuartierRequest;
use App\Http\Requests\UpdateQuartierRequest;
use App\Http\Resources\Admin\QuartierResource;
use App\Http\Resources\Admin\ReleaseGoodResource;
use App\Models\Quartier;
use App\Models\ReleaseGood;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuartierApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('quartier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //return new QuartierResource(Quartier::with(['set_countries', 'city'])->get());
       // return new ReleaseGoodResource(ReleaseGood::with(['propertytype', 'setcountry'])->get());

       $d=";nfds,l";
                  return json_encode("$d");
    }

    public function store(StoreQuartierRequest $request)
    {
        $quartier = Quartier::create($request->all());

        return (new QuartierResource($quartier))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Quartier $quartier)
    {
        abort_if(Gate::denies('quartier_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new QuartierResource($quartier->load(['set_countries', 'city']));
    }

    public function update(UpdateQuartierRequest $request, Quartier $quartier)
    {
        $quartier->update($request->all());

        return (new QuartierResource($quartier))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Quartier $quartier)
    {
        abort_if(Gate::denies('quartier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quartier->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function search(Request $request)
    {
        //var_dump($request->all());
        $input=$request->all();
        $cle=$input["setcity"];

        $quartiers = Quartier::whereCityId($cle)->orderBy('intitule', 'asc')->get()->toJson();

        //return response($quartiers, Response::HTTP_ACCEPTED);
        return response($quartiers);

    }

}
