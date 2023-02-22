<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyNeedLandRequest;
use App\Http\Requests\StoreNeedLandRequest;
use App\Http\Requests\UpdateNeedLandRequest;
use App\Models\City;
use App\Models\EmergencyLevel;
use App\Models\LandCategory;
use App\Models\ListStatut;
use App\Models\NeedLand;
use App\Models\PropertyType;
use App\Models\Quartier;
use App\Models\SetCountry;
use App\Models\TypeOffer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NeedLandController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('need_land_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = NeedLand::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory', 'emergencylevel'])->select(sprintf('%s.*', (new NeedLand())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'need_land_show';
                $editGate = 'need_land_edit';
                $deleteGate = 'need_land_delete';
                $crudRoutePart = 'need-lands';

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
            $table->addColumn('emergencylevel_intitule', function ($row) {
                return $row->emergencylevel ? $row->emergencylevel->intitule : '';
            });

            $table->editColumn('satisfait', function ($row) {
                return $row->satisfait ? $row->satisfait : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory', 'emergencylevel']);

            return $table->make(true);
        }

        $users            = User::get();
        $property_types   = PropertyType::get();
        $type_offers      = TypeOffer::get();
        $set_countries    = SetCountry::get();
        $cities           = City::get();
        $quartiers        = Quartier::get();
        $list_statuts     = ListStatut::get();
        $land_categories  = LandCategory::get();
        $emergency_levels = EmergencyLevel::get();

        return view('admin.needLands.index', compact('users', 'property_types', 'type_offers', 'set_countries', 'cities', 'quartiers', 'list_statuts', 'land_categories', 'emergency_levels'));
    }

    public function create()
    {
        abort_if(Gate::denies('need_land_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landcategories = LandCategory::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.needLands.create', compact('cities', 'emergencylevels', 'landcategories', 'liststatuts', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function store(StoreNeedLandRequest $request)
    {
        $needLand = NeedLand::create($request->all());

        return redirect()->route('admin.need-lands.index');
    }

    public function edit(NeedLand $needLand)
    {
        abort_if(Gate::denies('need_land_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landcategories = LandCategory::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $needLand->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory', 'emergencylevel');

        return view('admin.needLands.edit', compact('cities', 'emergencylevels', 'landcategories', 'liststatuts', 'needLand', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function update(UpdateNeedLandRequest $request, NeedLand $needLand)
    {
        $needLand->update($request->all());

        return redirect()->route('admin.need-lands.index');
    }

    public function show(NeedLand $needLand)
    {
        abort_if(Gate::denies('need_land_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $needLand->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'landcategory', 'emergencylevel');

        return view('admin.needLands.show', compact('needLand'));
    }

    public function destroy(NeedLand $needLand)
    {
        abort_if(Gate::denies('need_land_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $needLand->delete();

        return back();
    }

    public function massDestroy(MassDestroyNeedLandRequest $request)
    {
        NeedLand::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
