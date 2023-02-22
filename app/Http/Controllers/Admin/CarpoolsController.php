<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCarpoolRequest;
use App\Http\Requests\StoreCarpoolRequest;
use App\Http\Requests\UpdateCarpoolRequest;
use App\Models\Carpool;
use App\Models\CarpoolingVehicle;
use App\Models\ListStatut;
use App\Models\PaymentMode;
use App\Models\Trip;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CarpoolsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('carpool_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Carpool::with(['user_client', 'user_fournisseur', 'paymentmode', 'trip', 'liststatut', 'carpoolingvehicle'])->select(sprintf('%s.*', (new Carpool())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'carpool_show';
                $editGate = 'carpool_edit';
                $deleteGate = 'carpool_delete';
                $crudRoutePart = 'carpools';

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
            $table->addColumn('user_client_name', function ($row) {
                return $row->user_client ? $row->user_client->name : '';
            });

            $table->addColumn('user_fournisseur_name', function ($row) {
                return $row->user_fournisseur ? $row->user_fournisseur->name : '';
            });

            $table->editColumn('paiement', function ($row) {
                return $row->paiement ? $row->paiement : '';
            });
            $table->editColumn('preuve_paiement', function ($row) {
                return $row->preuve_paiement ? $row->preuve_paiement : '';
            });
            $table->addColumn('paymentmode_intitule', function ($row) {
                return $row->paymentmode ? $row->paymentmode->intitule : '';
            });

            $table->editColumn('mention_arrive', function ($row) {
                return $row->mention_arrive ? $row->mention_arrive : '';
            });
            $table->editColumn('mention_arv_heure', function ($row) {
                return $row->mention_arv_heure ? $row->mention_arv_heure : '';
            });
            $table->addColumn('trip_intitule', function ($row) {
                return $row->trip ? $row->trip->intitule : '';
            });

            $table->addColumn('liststatut_intitule', function ($row) {
                return $row->liststatut ? $row->liststatut->intitule : '';
            });

            $table->addColumn('carpoolingvehicle_libelle', function ($row) {
                return $row->carpoolingvehicle ? $row->carpoolingvehicle->libelle : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user_client', 'user_fournisseur', 'paymentmode', 'trip', 'liststatut', 'carpoolingvehicle']);

            return $table->make(true);
        }

        $users               = User::get();
        $payment_modes       = PaymentMode::get();
        $trips               = Trip::get();
        $list_statuts        = ListStatut::get();
        $carpooling_vehicles = CarpoolingVehicle::get();

        return view('admin.carpools.index', compact('users', 'payment_modes', 'trips', 'list_statuts', 'carpooling_vehicles'));
    }

    public function create()
    {
        abort_if(Gate::denies('carpool_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_fournisseurs = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentmodes = PaymentMode::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carpoolingvehicles = CarpoolingVehicle::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.carpools.create', compact('carpoolingvehicles', 'liststatuts', 'paymentmodes', 'trips', 'user_clients', 'user_fournisseurs'));
    }

    public function store(StoreCarpoolRequest $request)
    {
        $carpool = Carpool::create($request->all());

        return redirect()->route('admin.carpools.index');
    }

    public function edit(Carpool $carpool)
    {
        abort_if(Gate::denies('carpool_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_clients = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user_fournisseurs = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentmodes = PaymentMode::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carpoolingvehicles = CarpoolingVehicle::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $carpool->load('user_client', 'user_fournisseur', 'paymentmode', 'trip', 'liststatut', 'carpoolingvehicle');

        return view('admin.carpools.edit', compact('carpool', 'carpoolingvehicles', 'liststatuts', 'paymentmodes', 'trips', 'user_clients', 'user_fournisseurs'));
    }

    public function update(UpdateCarpoolRequest $request, Carpool $carpool)
    {
        $carpool->update($request->all());

        return redirect()->route('admin.carpools.index');
    }

    public function show(Carpool $carpool)
    {
        abort_if(Gate::denies('carpool_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpool->load('user_client', 'user_fournisseur', 'paymentmode', 'trip', 'liststatut', 'carpoolingvehicle');

        return view('admin.carpools.show', compact('carpool'));
    }

    public function destroy(Carpool $carpool)
    {
        abort_if(Gate::denies('carpool_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpool->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarpoolRequest $request)
    {
        Carpool::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
