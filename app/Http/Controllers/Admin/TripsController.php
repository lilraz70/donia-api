<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTripRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\ListStatut;
use App\Models\Trip;
use App\Models\TypeOfTrip;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TripsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('trip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Trip::with(['liststatut', 'user', 'typeoftrip'])->select(sprintf('%s.*', (new Trip())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'trip_show';
                $editGate = 'trip_edit';
                $deleteGate = 'trip_delete';
                $crudRoutePart = 'trips';

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
            $table->editColumn('intitule', function ($row) {
                return $row->intitule ? $row->intitule : '';
            });
            $table->editColumn('lieu_depart', function ($row) {
                return $row->lieu_depart ? $row->lieu_depart : '';
            });
            $table->editColumn('heure_depart', function ($row) {
                return $row->heure_depart ? $row->heure_depart : '';
            });
            $table->editColumn('lieu_arrive', function ($row) {
                return $row->lieu_arrive ? $row->lieu_arrive : '';
            });
            $table->editColumn('heure_arrive', function ($row) {
                return $row->heure_arrive ? $row->heure_arrive : '';
            });
            $table->addColumn('liststatut_intitule', function ($row) {
                return $row->liststatut ? $row->liststatut->intitule : '';
            });

            $table->editColumn('cout', function ($row) {
                return $row->cout ? $row->cout : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('typeoftrip_intitule', function ($row) {
                return $row->typeoftrip ? $row->typeoftrip->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'liststatut', 'user', 'typeoftrip']);

            return $table->make(true);
        }

        $list_statuts  = ListStatut::get();
        $users         = User::get();
        $type_of_trips = TypeOfTrip::get();

        return view('admin.trips.index', compact('list_statuts', 'users', 'type_of_trips'));
    }

    public function create()
    {
        abort_if(Gate::denies('trip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoftrips = TypeOfTrip::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.trips.create', compact('liststatuts', 'typeoftrips', 'users'));
    }

    public function store(StoreTripRequest $request)
    {
        $trip = Trip::create($request->all());

        return redirect()->route('admin.trips.index');
    }

    public function edit(Trip $trip)
    {
        abort_if(Gate::denies('trip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $liststatuts = ListStatut::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeoftrips = TypeOfTrip::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trip->load('liststatut', 'user', 'typeoftrip');

        return view('admin.trips.edit', compact('liststatuts', 'trip', 'typeoftrips', 'users'));
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->update($request->all());

        return redirect()->route('admin.trips.index');
    }

    public function show(Trip $trip)
    {
        abort_if(Gate::denies('trip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->load('liststatut', 'user', 'typeoftrip');

        return view('admin.trips.show', compact('trip'));
    }

    public function destroy(Trip $trip)
    {
        abort_if(Gate::denies('trip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->delete();

        return back();
    }

    public function massDestroy(MassDestroyTripRequest $request)
    {
        Trip::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
