<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyListStatutRequest;
use App\Http\Requests\StoreListStatutRequest;
use App\Http\Requests\UpdateListStatutRequest;
use App\Models\ListStatut;
use App\Models\Objecttype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ListStatutController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('list_statut_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ListStatut::with(['objecttype'])->select(sprintf('%s.*', (new ListStatut())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'list_statut_show';
                $editGate = 'list_statut_edit';
                $deleteGate = 'list_statut_delete';
                $crudRoutePart = 'list-statuts';

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
            $table->addColumn('objecttype_intitule', function ($row) {
                return $row->objecttype ? $row->objecttype->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'objecttype']);

            return $table->make(true);
        }

        $objecttypes = Objecttype::get();

        return view('admin.listStatuts.index', compact('objecttypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('list_statut_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.listStatuts.create', compact('objecttypes'));
    }

    public function store(StoreListStatutRequest $request)
    {
        $listStatut = ListStatut::create($request->all());

        return redirect()->route('admin.list-statuts.index');
    }

    public function edit(ListStatut $listStatut)
    {
        abort_if(Gate::denies('list_statut_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $listStatut->load('objecttype');

        return view('admin.listStatuts.edit', compact('listStatut', 'objecttypes'));
    }

    public function update(UpdateListStatutRequest $request, ListStatut $listStatut)
    {
        $listStatut->update($request->all());

        return redirect()->route('admin.list-statuts.index');
    }

    public function show(ListStatut $listStatut)
    {
        abort_if(Gate::denies('list_statut_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listStatut->load('objecttype');

        return view('admin.listStatuts.show', compact('listStatut'));
    }

    public function destroy(ListStatut $listStatut)
    {
        abort_if(Gate::denies('list_statut_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listStatut->delete();

        return back();
    }

    public function massDestroy(MassDestroyListStatutRequest $request)
    {
        ListStatut::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
