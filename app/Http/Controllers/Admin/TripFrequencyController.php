<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTripFrequencyRequest;
use App\Http\Requests\StoreTripFrequencyRequest;
use App\Http\Requests\UpdateTripFrequencyRequest;
use App\Models\Day;
use App\Models\Trip;
use App\Models\TripFrequency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TripFrequencyController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('trip_frequency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TripFrequency::with(['day', 'trip'])->select(sprintf('%s.*', (new TripFrequency())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'trip_frequency_show';
                $editGate = 'trip_frequency_edit';
                $deleteGate = 'trip_frequency_delete';
                $crudRoutePart = 'trip-frequencies';

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
            $table->addColumn('day_intitule', function ($row) {
                return $row->day ? $row->day->intitule : '';
            });

            $table->addColumn('trip_intitule', function ($row) {
                return $row->trip ? $row->trip->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'day', 'trip']);

            return $table->make(true);
        }

        $days  = Day::get();
        $trips = Trip::get();

        return view('admin.tripFrequencies.index', compact('days', 'trips'));
    }

    public function create()
    {
        abort_if(Gate::denies('trip_frequency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $days = Day::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tripFrequencies.create', compact('days', 'trips'));
    }

    public function store(StoreTripFrequencyRequest $request)
    {
        $tripFrequency = TripFrequency::create($request->all());

        return redirect()->route('admin.trip-frequencies.index');
    }

    public function edit(TripFrequency $tripFrequency)
    {
        abort_if(Gate::denies('trip_frequency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $days = Day::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tripFrequency->load('day', 'trip');

        return view('admin.tripFrequencies.edit', compact('days', 'tripFrequency', 'trips'));
    }

    public function update(UpdateTripFrequencyRequest $request, TripFrequency $tripFrequency)
    {
        $tripFrequency->update($request->all());

        return redirect()->route('admin.trip-frequencies.index');
    }

    public function show(TripFrequency $tripFrequency)
    {
        abort_if(Gate::denies('trip_frequency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tripFrequency->load('day', 'trip');

        return view('admin.tripFrequencies.show', compact('tripFrequency'));
    }

    public function destroy(TripFrequency $tripFrequency)
    {
        abort_if(Gate::denies('trip_frequency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tripFrequency->delete();

        return back();
    }

    public function massDestroy(MassDestroyTripFrequencyRequest $request)
    {
        TripFrequency::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
