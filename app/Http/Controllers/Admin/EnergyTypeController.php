<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEnergyTypeRequest;
use App\Http\Requests\StoreEnergyTypeRequest;
use App\Http\Requests\UpdateEnergyTypeRequest;
use App\Models\EnergyType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EnergyTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('energy_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EnergyType::query()->select(sprintf('%s.*', (new EnergyType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'energy_type_show';
                $editGate = 'energy_type_edit';
                $deleteGate = 'energy_type_delete';
                $crudRoutePart = 'energy-types';

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

        return view('admin.energyTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('energy_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.energyTypes.create');
    }

    public function store(StoreEnergyTypeRequest $request)
    {
        $energyType = EnergyType::create($request->all());

        return redirect()->route('admin.energy-types.index');
    }

    public function edit(EnergyType $energyType)
    {
        abort_if(Gate::denies('energy_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.energyTypes.edit', compact('energyType'));
    }

    public function update(UpdateEnergyTypeRequest $request, EnergyType $energyType)
    {
        $energyType->update($request->all());

        return redirect()->route('admin.energy-types.index');
    }

    public function show(EnergyType $energyType)
    {
        abort_if(Gate::denies('energy_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.energyTypes.show', compact('energyType'));
    }

    public function destroy(EnergyType $energyType)
    {
        abort_if(Gate::denies('energy_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $energyType->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnergyTypeRequest $request)
    {
        EnergyType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
