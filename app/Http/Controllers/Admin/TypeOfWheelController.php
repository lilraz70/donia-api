<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTypeOfWheelRequest;
use App\Http\Requests\StoreTypeOfWheelRequest;
use App\Http\Requests\UpdateTypeOfWheelRequest;
use App\Models\TypeOfWheel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TypeOfWheelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('type_of_wheel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TypeOfWheel::query()->select(sprintf('%s.*', (new TypeOfWheel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'type_of_wheel_show';
                $editGate = 'type_of_wheel_edit';
                $deleteGate = 'type_of_wheel_delete';
                $crudRoutePart = 'type-of-wheels';

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

        return view('admin.typeOfWheels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('type_of_wheel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfWheels.create');
    }

    public function store(StoreTypeOfWheelRequest $request)
    {
        $typeOfWheel = TypeOfWheel::create($request->all());

        return redirect()->route('admin.type-of-wheels.index');
    }

    public function edit(TypeOfWheel $typeOfWheel)
    {
        abort_if(Gate::denies('type_of_wheel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfWheels.edit', compact('typeOfWheel'));
    }

    public function update(UpdateTypeOfWheelRequest $request, TypeOfWheel $typeOfWheel)
    {
        $typeOfWheel->update($request->all());

        return redirect()->route('admin.type-of-wheels.index');
    }

    public function show(TypeOfWheel $typeOfWheel)
    {
        abort_if(Gate::denies('type_of_wheel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfWheels.show', compact('typeOfWheel'));
    }

    public function destroy(TypeOfWheel $typeOfWheel)
    {
        abort_if(Gate::denies('type_of_wheel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfWheel->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeOfWheelRequest $request)
    {
        TypeOfWheel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
