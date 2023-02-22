<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReleaseGoodRequest;
use App\Http\Requests\StoreReleaseGoodRequest;
use App\Http\Requests\UpdateReleaseGoodRequest;
use App\Http\Resources\Admin\ReleaseGoodResource;
use App\Http\Resources\Admin\QuartierResource;
use App\Models\City;
use App\Models\EmergencyLevel;
use App\Models\ListStatut;
use App\Models\PropertyType;
use App\Models\Quartier;
use App\Models\ReleaseGood;
use App\Models\SetCountry;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReleaseGoodController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('release_good_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


          //return new QuartierResource(Quartier::with(['set_countries', 'city'])->get());
            $d=";nfds,l";
           return json_encode("$d");
    }

    public function create()
    {
        abort_if(Gate::denies('release_good_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.releaseGoods.create', compact('cities', 'emergencylevels', 'liststatuts', 'propertytypes', 'quartiers', 'setcountries', 'users'));
    }

    public function store(StoreReleaseGoodRequest $request)
    {
        $releaseGood = ReleaseGood::create($request->all());

        return redirect()->route('admin.release-goods.index');
    }

    public function edit(ReleaseGood $releaseGood)
    {
        abort_if(Gate::denies('release_good_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $releaseGood->load('propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel');

        return view('admin.releaseGoods.edit', compact('cities', 'emergencylevels', 'liststatuts', 'propertytypes', 'quartiers', 'releaseGood', 'setcountries', 'users'));
    }

    public function update(UpdateReleaseGoodRequest $request, ReleaseGood $releaseGood)
    {
        $releaseGood->update($request->all());

        return redirect()->route('admin.release-goods.index');
    }

    public function show(ReleaseGood $releaseGood)
    {
        abort_if(Gate::denies('release_good_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releaseGood->load('propertytype', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel');

        return view('admin.releaseGoods.show', compact('releaseGood'));
    }

    public function destroy(ReleaseGood $releaseGood)
    {
        abort_if(Gate::denies('release_good_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releaseGood->delete();

        return back();
    }

    public function massDestroy(MassDestroyReleaseGoodRequest $request)
    {
        ReleaseGood::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
