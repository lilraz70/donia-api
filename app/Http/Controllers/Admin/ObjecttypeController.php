<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyObjecttypeRequest;
use App\Http\Requests\StoreObjecttypeRequest;
use App\Http\Requests\UpdateObjecttypeRequest;
use App\Models\Objecttype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ObjecttypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('objecttype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Objecttype::query()->select(sprintf('%s.*', (new Objecttype())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'objecttype_show';
                $editGate = 'objecttype_edit';
                $deleteGate = 'objecttype_delete';
                $crudRoutePart = 'objecttypes';

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

        return view('admin.objecttypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('objecttype_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.objecttypes.create');
    }

    public function store(StoreObjecttypeRequest $request)
    {
        $objecttype = Objecttype::create($request->all());

        return redirect()->route('admin.objecttypes.index');
    }

    public function edit(Objecttype $objecttype)
    {
        abort_if(Gate::denies('objecttype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.objecttypes.edit', compact('objecttype'));
    }

    public function update(UpdateObjecttypeRequest $request, Objecttype $objecttype)
    {
        $objecttype->update($request->all());

        return redirect()->route('admin.objecttypes.index');
    }

    public function show(Objecttype $objecttype)
    {
        abort_if(Gate::denies('objecttype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.objecttypes.show', compact('objecttype'));
    }

    public function destroy(Objecttype $objecttype)
    {
        abort_if(Gate::denies('objecttype_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttype->delete();

        return back();
    }

    public function massDestroy(MassDestroyObjecttypeRequest $request)
    {
        Objecttype::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
