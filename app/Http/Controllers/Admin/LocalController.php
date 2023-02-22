<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLocalRequest;
use App\Http\Requests\StoreLocalRequest;
use App\Http\Requests\UpdateLocalRequest;
use App\Models\City;
use App\Models\ListStatut;
use App\Models\Local;
use App\Models\PropertyType;
use App\Models\Quartier;
use App\Models\SetCountry;
use App\Models\TypeOffer;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocalController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('local_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Local::with(['user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut'])->select(sprintf('%s.*', (new Local())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'local_show';
                $editGate = 'local_edit';
                $deleteGate = 'local_delete';
                $crudRoutePart = 'locals';

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
            $table->editColumn('libelle', function ($row) {
                return $row->libelle ? $row->libelle : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut']);

            return $table->make(true);
        }

        $users          = User::get();
        $property_types = PropertyType::get();
        $type_offers    = TypeOffer::get();
        $set_countries  = SetCountry::get();
        $cities         = City::get();
        $quartiers      = Quartier::get();
        $list_statuts   = ListStatut::get();

        return view('admin.locals.index', compact('users', 'property_types', 'type_offers', 'set_countries', 'cities', 'quartiers', 'list_statuts'));
    }

    public function create()
    {
        abort_if(Gate::denies('local_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.locals.create', compact('cities', 'liststatuts', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function store(StoreLocalRequest $request)
    {
        $local = Local::create($request->all());

        return redirect()->route('admin.locals.index');
    }

    public function edit(Local $local)
    {
        abort_if(Gate::denies('local_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $propertytypes = PropertyType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoffers = TypeOffer::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $setcountries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartiers = Quartier::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $local->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut');

        return view('admin.locals.edit', compact('cities', 'liststatuts', 'local', 'propertytypes', 'quartiers', 'setcountries', 'typeoffers', 'users'));
    }

    public function update(UpdateLocalRequest $request, Local $local)
    {
        $local->update($request->all());

        return redirect()->route('admin.locals.index');
    }

    public function show(Local $local)
    {
        abort_if(Gate::denies('local_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local->load('user', 'propertytype', 'typeoffer', 'setcountry', 'city', 'quartier', 'liststatut');

        return view('admin.locals.show', compact('local'));
    }

    public function destroy(Local $local)
    {
        abort_if(Gate::denies('local_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocalRequest $request)
    {
        Local::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
