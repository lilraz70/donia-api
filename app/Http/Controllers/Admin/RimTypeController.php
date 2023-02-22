<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRimTypeRequest;
use App\Http\Requests\StoreRimTypeRequest;
use App\Http\Requests\UpdateRimTypeRequest;
use App\Models\RimType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RimTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('rim_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RimType::query()->select(sprintf('%s.*', (new RimType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rim_type_show';
                $editGate = 'rim_type_edit';
                $deleteGate = 'rim_type_delete';
                $crudRoutePart = 'rim-types';

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

        return view('admin.rimTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('rim_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rimTypes.create');
    }

    public function store(StoreRimTypeRequest $request)
    {
        $rimType = RimType::create($request->all());

        return redirect()->route('admin.rim-types.index');
    }

    public function edit(RimType $rimType)
    {
        abort_if(Gate::denies('rim_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rimTypes.edit', compact('rimType'));
    }

    public function update(UpdateRimTypeRequest $request, RimType $rimType)
    {
        $rimType->update($request->all());

        return redirect()->route('admin.rim-types.index');
    }

    public function show(RimType $rimType)
    {
        abort_if(Gate::denies('rim_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rimTypes.show', compact('rimType'));
    }

    public function destroy(RimType $rimType)
    {
        abort_if(Gate::denies('rim_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rimType->delete();

        return back();
    }

    public function massDestroy(MassDestroyRimTypeRequest $request)
    {
        RimType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
