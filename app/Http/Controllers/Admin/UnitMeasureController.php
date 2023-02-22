<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUnitMeasureRequest;
use App\Http\Requests\StoreUnitMeasureRequest;
use App\Http\Requests\UpdateUnitMeasureRequest;
use App\Models\UnitMeasure;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UnitMeasureController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('unit_measure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UnitMeasure::query()->select(sprintf('%s.*', (new UnitMeasure())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'unit_measure_show';
                $editGate = 'unit_measure_edit';
                $deleteGate = 'unit_measure_delete';
                $crudRoutePart = 'unit-measures';

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

        return view('admin.unitMeasures.index');
    }

    public function create()
    {
        abort_if(Gate::denies('unit_measure_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.unitMeasures.create');
    }

    public function store(StoreUnitMeasureRequest $request)
    {
        $unitMeasure = UnitMeasure::create($request->all());

        return redirect()->route('admin.unit-measures.index');
    }

    public function edit(UnitMeasure $unitMeasure)
    {
        abort_if(Gate::denies('unit_measure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.unitMeasures.edit', compact('unitMeasure'));
    }

    public function update(UpdateUnitMeasureRequest $request, UnitMeasure $unitMeasure)
    {
        $unitMeasure->update($request->all());

        return redirect()->route('admin.unit-measures.index');
    }

    public function show(UnitMeasure $unitMeasure)
    {
        abort_if(Gate::denies('unit_measure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.unitMeasures.show', compact('unitMeasure'));
    }

    public function destroy(UnitMeasure $unitMeasure)
    {
        abort_if(Gate::denies('unit_measure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $unitMeasure->delete();

        return back();
    }

    public function massDestroy(MassDestroyUnitMeasureRequest $request)
    {
        UnitMeasure::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
