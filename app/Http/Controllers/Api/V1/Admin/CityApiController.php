<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\Admin\CityResource;
use App\Models\City;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CityResource(City::with(['set_countries'])->get());
    }

    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(City $city)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CityResource($city->load(['set_countries']));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function search(Request $request)
    {
        //var_dump($request->all());
        $input=$request->all();
        $cle=$input["setcountry"];

        $cities = City::whereSetCountriesId($cle)->get()->toJson();

        return response($cities, Response::HTTP_ACCEPTED);

    }


     public function allCityName(Request $request,  $country_id)
        {

              //$cities = City::where('set_countries_id', '=', $country_id)->pluck('intitule');
               //$cities = City::pluck('intitule');

        $cities = City::select('id', 'intitule')->where('set_countries_id', '=', $country_id)->orderBy('intitule', 'asc')->get()->toJson();
            return response($cities, Response::HTTP_ACCEPTED);

        }


     public function cityId(Request $request,  $name)
                {

                      //$cities = City::where('set_countries_id', '=', $country_id)->pluck('intitule');
                       //$cities = City::pluck('intitule');

                $cities = City::select('id')->where('intitule', '=', $name)->get()->toJson();
                    return response($cities, Response::HTTP_ACCEPTED);

                }
}
