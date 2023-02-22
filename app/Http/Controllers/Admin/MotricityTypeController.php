<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyMotricityTypeRequest;
use App\Http\Requests\StoreMotricityTypeRequest;
use App\Http\Requests\UpdateMotricityTypeRequest;
use App\Models\MotricityType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MotricityTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('motricity_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MotricityType::query()->select(sprintf('%s.*', (new MotricityType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'motricity_type_show';
                $editGate = 'motricity_type_edit';
                $deleteGate = 'motricity_type_delete';
                $crudRoutePart = 'motricity-types';

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

        return view('admin.motricityTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('motricity_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motricityTypes.create');
    }

    public function store(StoreMotricityTypeRequest $request)
    {
        $motricityType = MotricityType::create($request->all());

        return redirect()->route('admin.motricity-types.index');
    }

    public function edit(MotricityType $motricityType)
    {
        abort_if(Gate::denies('motricity_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motricityTypes.edit', compact('motricityType'));
    }

    public function update(UpdateMotricityTypeRequest $request, MotricityType $motricityType)
    {
        $motricityType->update($request->all());

        return redirect()->route('admin.motricity-types.index');
    }

    public function show(MotricityType $motricityType)
    {
        abort_if(Gate::denies('motricity_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.motricityTypes.show', compact('motricityType'));
    }

    public function destroy(MotricityType $motricityType)
    {
        abort_if(Gate::denies('motricity_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $motricityType->delete();

        return back();
    }

    public function massDestroy(MassDestroyMotricityTypeRequest $request)
    {
        MotricityType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
