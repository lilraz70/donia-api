<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBesoinLocalRequest;
use App\Http\Requests\StoreBesoinLocalRequest;
use App\Http\Requests\UpdateBesoinLocalRequest;
use App\Models\BesoinLocal;
use App\Models\City;
use App\Models\EmergencyLevel;
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

class BesoinLocalController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('besoin_local_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BesoinLocal::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'emergencylevel'])->select(sprintf('%s.*', (new BesoinLocal())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'besoin_local_show';
                $editGate = 'besoin_local_edit';
                $deleteGate = 'besoin_local_delete';
                $crudRoutePart = 'besoin-locals';

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
            $table->editColumn('nb_chambre', function ($row) {
                return $row->nb_chambre ? $row->nb_chambre : '';
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
            $table->editColumn('libelle', function ($row) {
                return $row->libelle ? $row->libelle : '';
            });

            $table->editColumn('budget_max_achat', function ($row) {
                return $row->budget_max_achat ? $row->budget_max_achat : '';
            });
            $table->editColumn('budget_max_location', function ($row) {
                return $row->budget_max_location ? $row->budget_max_location : '';
            });
            $table->addColumn('emergencylevel_intitule', function ($row) {
                return $row->emergencylevel ? $row->emergencylevel->intitule : '';
            });

            $table->editColumn('satisfait', function ($row) {
                return $row->satisfait ? $row->satisfait : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'emergencylevel']);

            return $table->make(true);
        }

        $users            = User::get();
        $property_types   = PropertyType::get();
        $type_offers      = TypeOffer::get();
        $set_countries    = SetCountry::get();
        $cities           = City::get();
        $quartiers        = Quartier::get();
        $list_statuts     = ListStatut::get();
        $emergency_levels = EmergencyLevel::get();

        return view('admin.besoinLocals.index', compact('users', 'property_types', 'type_offers', 'set_countries', 'cities', 'quartiers', 'list_statuts', 'emergency_levels'));
    }

    public function create()
    {
        abort_if(Gate::denies('besoin_local_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.besoinLocals.create', compact('cities', 'emergencylevels', 'liststatuts', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function store(StoreBesoinLocalRequest $request)
    {
        $besoinLocal = BesoinLocal::create($request->all());

        return redirect()->route('admin.besoin-locals.index');
    }

    public function edit(BesoinLocal $besoinLocal)
    {
        abort_if(Gate::denies('besoin_local_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $besoinLocal->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'emergencylevel');

        return view('admin.besoinLocals.edit', compact('besoinLocal', 'cities', 'emergencylevels', 'liststatuts', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function update(UpdateBesoinLocalRequest $request, BesoinLocal $besoinLocal)
    {
        $besoinLocal->update($request->all());

        return redirect()->route('admin.besoin-locals.index');
    }

    public function show(BesoinLocal $besoinLocal)
    {
        abort_if(Gate::denies('besoin_local_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $besoinLocal->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut', 'emergencylevel');

        return view('admin.besoinLocals.show', compact('besoinLocal'));
    }

    public function destroy(BesoinLocal $besoinLocal)
    {
        abort_if(Gate::denies('besoin_local_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $besoinLocal->delete();

        return back();
    }

    public function massDestroy(MassDestroyBesoinLocalRequest $request)
    {
        BesoinLocal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
