<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVehicleAvailabilityRequest;
use App\Http\Requests\StoreVehicleAvailabilityRequest;
use App\Http\Requests\UpdateVehicleAvailabilityRequest;
use App\Models\SellRentCar;
use App\Models\VehicleAvailability;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VehicleAvailabilityController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vehicle_availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = VehicleAvailability::with(['sellrentcar'])->select(sprintf('%s.*', (new VehicleAvailability())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'vehicle_availability_show';
                $editGate = 'vehicle_availability_edit';
                $deleteGate = 'vehicle_availability_delete';
                $crudRoutePart = 'vehicle-availabilities';

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

            $table->editColumn('heure_debut', function ($row) {
                return $row->heure_debut ? $row->heure_debut : '';
            });

            $table->editColumn('heure_fin', function ($row) {
                return $row->heure_fin ? $row->heure_fin : '';
            });
            $table->addColumn('sellrentcar_libelle', function ($row) {
                return $row->sellrentcar ? $row->sellrentcar->libelle : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'sellrentcar']);

            return $table->make(true);
        }

        $sell_rent_cars = SellRentCar::get();

        return view('admin.vehicleAvailabilities.index', compact('sell_rent_cars'));
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_availability_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sellrentcars = SellRentCar::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vehicleAvailabilities.create', compact('sellrentcars'));
    }

    public function store(StoreVehicleAvailabilityRequest $request)
    {
        $vehicleAvailability = VehicleAvailability::create($request->all());

        return redirect()->route('admin.vehicle-availabilities.index');
    }

    public function edit(VehicleAvailability $vehicleAvailability)
    {
        abort_if(Gate::denies('vehicle_availability_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sellrentcars = SellRentCar::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicleAvailability->load('sellrentcar');

        return view('admin.vehicleAvailabilities.edit', compact('sellrentcars', 'vehicleAvailability'));
    }

    public function update(UpdateVehicleAvailabilityRequest $request, VehicleAvailability $vehicleAvailability)
    {
        $vehicleAvailability->update($request->all());

        return redirect()->route('admin.vehicle-availabilities.index');
    }

    public function show(VehicleAvailability $vehicleAvailability)
    {
        abort_if(Gate::denies('vehicle_availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleAvailability->load('sellrentcar');

        return view('admin.vehicleAvailabilities.show', compact('vehicleAvailability'));
    }

    public function destroy(VehicleAvailability $vehicleAvailability)
    {
        abort_if(Gate::denies('vehicle_availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicleAvailability->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleAvailabilityRequest $request)
    {
        VehicleAvailability::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
