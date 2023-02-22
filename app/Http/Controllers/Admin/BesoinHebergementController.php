<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBesoinHebergementRequest;
use App\Http\Requests\StoreBesoinHebergementRequest;
use App\Http\Requests\UpdateBesoinHebergementRequest;
use App\Models\BesoinHebergement;
use App\Models\City;
use App\Models\EmergencyLevel;
use App\Models\HostingType;
use App\Models\ListStatut;
use App\Models\Quartier;
use App\Models\SetCountry;
use App\Models\TypeOfHouse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BesoinHebergementController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('besoin_hebergement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = BesoinHebergement::with(['hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel'])->select(sprintf('%s.*', (new BesoinHebergement())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'besoin_hebergement_show';
                $editGate = 'besoin_hebergement_edit';
                $deleteGate = 'besoin_hebergement_delete';
                $crudRoutePart = 'besoin-hebergements';

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
            $table->editColumn('prix_journalier', function ($row) {
                return $row->prix_journalier ? $row->prix_journalier : '';
            });
            $table->editColumn('prix_mensuel', function ($row) {
                return $row->prix_mensuel ? $row->prix_mensuel : '';
            });
            $table->editColumn('localisation', function ($row) {
                return $row->localisation ? $row->localisation : '';
            });
            $table->editColumn('geolocalisation', function ($row) {
                return $row->geolocalisation ? $row->geolocalisation : '';
            });
            $table->addColumn('hostingtype_intitule', function ($row) {
                return $row->hostingtype ? $row->hostingtype->intitule : '';
            });

            $table->addColumn('typeofhouse_intitule', function ($row) {
                return $row->typeofhouse ? $row->typeofhouse->intitule : '';
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

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('liststatut_intitule', function ($row) {
                return $row->liststatut ? $row->liststatut->intitule : '';
            });

            $table->editColumn('libelle', function ($row) {
                return $row->libelle ? $row->libelle : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('emergencylevel_intitule', function ($row) {
                return $row->emergencylevel ? $row->emergencylevel->intitule : '';
            });

            $table->editColumn('satisfait', function ($row) {
                return $row->satisfait ? $row->satisfait : '';
            });

            $table->editColumn('conveniences', function ($row) {
                return $row->conveniences ? $row->conveniences : '';
            });
            $table->editColumn('servicesinclus', function ($row) {
                return $row->servicesinclus ? $row->servicesinclus : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel']);

            return $table->make(true);
        }

        $hosting_types    = HostingType::get();
        $type_of_houses   = TypeOfHouse::get();
        $set_countries    = SetCountry::get();
        $cities           = City::get();
        $quartiers        = Quartier::get();
        $users            = User::get();
        $list_statuts     = ListStatut::get();
        $emergency_levels = EmergencyLevel::get();

        return view('admin.besoinHebergements.index', compact('hosting_types', 'type_of_houses', 'set_countries', 'cities', 'quartiers', 'users', 'list_statuts', 'emergency_levels'));
    }

    public function create()
    {
        abort_if(Gate::denies('besoin_hebergement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingtypes = HostingType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofhouses = TypeOfHouse::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.besoinHebergements.create', compact('cities', 'emergencylevels', 'hostingtypes', 'liststatuts', 'quartiers', 'setcountries', 'typeofhouses', 'users'));
    }

    public function store(StoreBesoinHebergementRequest $request)
    {
        $besoinHebergement = BesoinHebergement::create($request->all());

        return redirect()->route('admin.besoin-hebergements.index');
    }

    public function edit(BesoinHebergement $besoinHebergement)
    {
        abort_if(Gate::denies('besoin_hebergement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingtypes = HostingType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofhouses = TypeOfHouse::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $emergencylevels = EmergencyLevel::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $besoinHebergement->load('hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel');

        return view('admin.besoinHebergements.edit', compact('besoinHebergement', 'cities', 'emergencylevels', 'hostingtypes', 'liststatuts', 'quartiers', 'setcountries', 'typeofhouses', 'users'));
    }

    public function update(UpdateBesoinHebergementRequest $request, BesoinHebergement $besoinHebergement)
    {
        $besoinHebergement->update($request->all());

        return redirect()->route('admin.besoin-hebergements.index');
    }

    public function show(BesoinHebergement $besoinHebergement)
    {
        abort_if(Gate::denies('besoin_hebergement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $besoinHebergement->load('hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut', 'emergencylevel');

        return view('admin.besoinHebergements.show', compact('besoinHebergement'));
    }

    public function destroy(BesoinHebergement $besoinHebergement)
    {
        abort_if(Gate::denies('besoin_hebergement_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $besoinHebergement->delete();

        return back();
    }

    public function massDestroy(MassDestroyBesoinHebergementRequest $request)
    {
        BesoinHebergement::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
