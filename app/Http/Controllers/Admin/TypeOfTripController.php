<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTypeOfTripRequest;
use App\Http\Requests\StoreTypeOfTripRequest;
use App\Http\Requests\UpdateTypeOfTripRequest;
use App\Models\TypeOfTrip;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TypeOfTripController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('type_of_trip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TypeOfTrip::query()->select(sprintf('%s.*', (new TypeOfTrip())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'type_of_trip_show';
                $editGate = 'type_of_trip_edit';
                $deleteGate = 'type_of_trip_delete';
                $crudRoutePart = 'type-of-trips';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.typeOfTrips.index');
    }

    public function create()
    {
        abort_if(Gate::denies('type_of_trip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfTrips.create');
    }

    public function store(StoreTypeOfTripRequest $request)
    {
        $typeOfTrip = TypeOfTrip::create($request->all());

        return redirect()->route('admin.type-of-trips.index');
    }

    public function edit(TypeOfTrip $typeOfTrip)
    {
        abort_if(Gate::denies('type_of_trip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfTrips.edit', compact('typeOfTrip'));
    }

    public function update(UpdateTypeOfTripRequest $request, TypeOfTrip $typeOfTrip)
    {
        $typeOfTrip->update($request->all());

        return redirect()->route('admin.type-of-trips.index');
    }

    public function show(TypeOfTrip $typeOfTrip)
    {
        abort_if(Gate::denies('type_of_trip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfTrips.show', compact('typeOfTrip'));
    }

    public function destroy(TypeOfTrip $typeOfTrip)
    {
        abort_if(Gate::denies('type_of_trip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfTrip->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeOfTripRequest $request)
    {
        TypeOfTrip::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
