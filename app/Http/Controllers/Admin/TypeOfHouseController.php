<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTypeOfHouseRequest;
use App\Http\Requests\StoreTypeOfHouseRequest;
use App\Http\Requests\UpdateTypeOfHouseRequest;
use App\Models\TypeOfHouse;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TypeOfHouseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('type_of_house_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TypeOfHouse::query()->select(sprintf('%s.*', (new TypeOfHouse())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'type_of_house_show';
                $editGate = 'type_of_house_edit';
                $deleteGate = 'type_of_house_delete';
                $crudRoutePart = 'type-of-houses';

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

        return view('admin.typeOfHouses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('type_of_house_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfHouses.create');
    }

    public function store(StoreTypeOfHouseRequest $request)
    {
        $typeOfHouse = TypeOfHouse::create($request->all());

        return redirect()->route('admin.type-of-houses.index');
    }

    public function edit(TypeOfHouse $typeOfHouse)
    {
        abort_if(Gate::denies('type_of_house_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfHouses.edit', compact('typeOfHouse'));
    }

    public function update(UpdateTypeOfHouseRequest $request, TypeOfHouse $typeOfHouse)
    {
        $typeOfHouse->update($request->all());

        return redirect()->route('admin.type-of-houses.index');
    }

    public function show(TypeOfHouse $typeOfHouse)
    {
        abort_if(Gate::denies('type_of_house_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfHouses.show', compact('typeOfHouse'));
    }

    public function destroy(TypeOfHouse $typeOfHouse)
    {
        abort_if(Gate::denies('type_of_house_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfHouse->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeOfHouseRequest $request)
    {
        TypeOfHouse::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
