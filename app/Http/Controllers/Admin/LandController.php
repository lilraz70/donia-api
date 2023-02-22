<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLandRequest;
use App\Http\Requests\StoreLandRequest;
use App\Http\Requests\UpdateLandRequest;
use App\Models\City;
use App\Models\Land;
use App\Models\LandCategory;
use App\Models\ListStatut;
use App\Models\PropertyType;
use App\Models\Quartier;
use App\Models\SetCountry;
use App\Models\TypeOffer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LandController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('land_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Land::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory'])->select(sprintf('%s.*', (new Land())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'land_show';
                $editGate = 'land_edit';
                $deleteGate = 'land_delete';
                $crudRoutePart = 'lands';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('superficie', function ($row) {
                return $row->superficie ? $row->superficie : '';
            });
            $table->editColumn('localisation', function ($row) {
                return $row->localisation ? $row->localisation : '';
            });
            $table->editColumn('geolocalisation', function ($row) {
                return $row->geolocalisation ? $row->geolocalisation : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('propertytype_intitule', function ($row) {
                return $row->propertytype ? $row->propertytype->intitule : '';
            });

            $table->addColumn('typeoffer_intitule', function ($row) {
                return $row->typeoffer ? $row->typeoffer->intitule : '';
            });

            $table->addColumn('setcountry_intitule', function ($row) {
                return $row->setcountry ? $row->setcountry->intitule : '';
            });

            $table->addColumn('city_intitule', function ($row) {
                return $row->city ? $row->city->intitule : '';
            });

            $table->addColumn('quartier_intitule', function ($row) {
                return $row->quartier ? $row->quartier->intitule : '';
            });

            $table->editColumn('prix_vente', function ($row) {
                return $row->prix_vente ? $row->prix_vente : '';
            });
            $table->editColumn('prix_location', function ($row) {
                return $row->prix_location ? $row->prix_location : '';
            });
            $table->editColumn('condition_location', function ($row) {
                return $row->condition_location ? $row->condition_location : '';
            });
            $table->editColumn('condition_vente', function ($row) {
                return $row->condition_vente ? $row->condition_vente : '';
            });
            $table->addColumn('liststatut_intitule', function ($row) {
                return $row->liststatut ? $row->liststatut->intitule : '';
            });

            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('landcategory_intitule', function ($row) {
                return $row->landcategory ? $row->landcategory->intitule : '';
            });

            $table->editColumn('libelle', function ($row) {
                return $row->libelle ? $row->libelle : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory']);

            return $table->make(true);
        }

        $users           = User::get();
        $property_types  = PropertyType::get();
        $type_offers     = TypeOffer::get();
        $set_countries   = SetCountry::get();
        $cities          = City::get();
        $quartiers       = Quartier::get();
        $list_statuts    = ListStatut::get();
        $land_categories = LandCategory::get();

        return view('admin.lands.index', compact('users', 'property_types', 'type_offers', 'set_countries', 'cities', 'quartiers', 'list_statuts', 'land_categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('land_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landcategories = LandCategory::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lands.create', compact('cities', 'landcategories', 'liststatuts', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function store(StoreLandRequest $request)
    {
        $land = Land::create($request->all());

        return redirect()->route('admin.lands.index');
    }

    public function edit(Land $land)
    {
        abort_if(Gate::denies('land_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landcategories = LandCategory::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $land->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory');

        return view('admin.lands.edit', compact('cities', 'land', 'landcategories', 'liststatuts', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function update(UpdateLandRequest $request, Land $land)
    {
        $land->update($request->all());

        return redirect()->route('admin.lands.index');
    }

    public function show(Land $land)
    {
        abort_if(Gate::denies('land_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $land->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory');

        return view('admin.lands.show', compact('land'));
    }

    public function destroy(Land $land)
    {
        abort_if(Gate::denies('land_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $land->delete();

        return back();
    }

    public function massDestroy(MassDestroyLandRequest $request)
    {
        Land::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
