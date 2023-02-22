<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLodgingRequest;
use App\Http\Requests\StoreLodgingRequest;
use App\Http\Requests\UpdateLodgingRequest;
use App\Models\City;
use App\Models\HostingType;
use App\Models\ListStatut;
use App\Models\Lodging;
use App\Models\Quartier;
use App\Models\SetCountry;
use App\Models\TypeOfHouse;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LodgingController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lodging_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lodging::with(['hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut'])->select(sprintf('%s.*', (new Lodging())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lodging_show';
                $editGate = 'lodging_edit';
                $deleteGate = 'lodging_delete';
                $crudRoutePart = 'lodgings';

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

            $table->rawColumns(['actions', 'placeholder', 'hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut']);

            return $table->make(true);
        }

        $hosting_types  = HostingType::get();
        $type_of_houses = TypeOfHouse::get();
        $set_countries  = SetCountry::get();
        $cities         = City::get();
        $quartiers      = Quartier::get();
        $users          = User::get();
        $list_statuts   = ListStatut::get();

        return view('admin.lodgings.index', compact('hosting_types', 'type_of_houses', 'set_countries', 'cities', 'quartiers', 'users', 'list_statuts'));
    }

    public function create()
    {
        abort_if(Gate::denies('lodging_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingtypes = HostingType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofhouses = TypeOfHouse::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lodgings.create', compact('cities', 'hostingtypes', 'liststatuts', 'quartiers', 'setcountries', 'typeofhouses', 'users'));
    }

    public function store(StoreLodgingRequest $request)
    {
        $lodging = Lodging::create($request->all());

        return redirect()->route('admin.lodgings.index');
    }

    public function edit(Lodging $lodging)
    {
        abort_if(Gate::denies('lodging_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingtypes = HostingType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofhouses = TypeOfHouse::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lodging->load('hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut');

        return view('admin.lodgings.edit', compact('cities', 'hostingtypes', 'liststatuts', 'lodging', 'quartiers', 'setcountries', 'typeofhouses', 'users'));
    }

    public function update(UpdateLodgingRequest $request, Lodging $lodging)
    {
        $lodging->update($request->all());

        return redirect()->route('admin.lodgings.index');
    }

    public function show(Lodging $lodging)
    {
        abort_if(Gate::denies('lodging_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodging->load('hostingtype', 'typeofhouse', 'setcountry', 'city', 'quartier', 'user', 'liststatut');

        return view('admin.lodgings.show', compact('lodging'));
    }

    public function destroy(Lodging $lodging)
    {
        abort_if(Gate::denies('lodging_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodging->delete();

        return back();
    }

    public function massDestroy(MassDestroyLodgingRequest $request)
    {
        Lodging::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
