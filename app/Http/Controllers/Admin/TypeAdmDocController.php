<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTypeAdmDocRequest;
use App\Http\Requests\StoreTypeAdmDocRequest;
use App\Http\Requests\UpdateTypeAdmDocRequest;
use App\Models\TypeAdmDoc;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TypeAdmDocController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('type_adm_doc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TypeAdmDoc::query()->select(sprintf('%s.*', (new TypeAdmDoc())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'type_adm_doc_show';
                $editGate = 'type_adm_doc_edit';
                $deleteGate = 'type_adm_doc_delete';
                $crudRoutePart = 'type-adm-docs';

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

        return view('admin.typeAdmDocs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('type_adm_doc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeAdmDocs.create');
    }

    public function store(StoreTypeAdmDocRequest $request)
    {
        $typeAdmDoc = TypeAdmDoc::create($request->all());

        return redirect()->route('admin.type-adm-docs.index');
    }

    public function edit(TypeAdmDoc $typeAdmDoc)
    {
        abort_if(Gate::denies('type_adm_doc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeAdmDocs.edit', compact('typeAdmDoc'));
    }

    public function update(UpdateTypeAdmDocRequest $request, TypeAdmDoc $typeAdmDoc)
    {
        $typeAdmDoc->update($request->all());

        return redirect()->route('admin.type-adm-docs.index');
    }

    public function show(TypeAdmDoc $typeAdmDoc)
    {
        abort_if(Gate::denies('type_adm_doc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeAdmDocs.show', compact('typeAdmDoc'));
    }

    public function destroy(TypeAdmDoc $typeAdmDoc)
    {
        abort_if(Gate::denies('type_adm_doc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeAdmDoc->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeAdmDocRequest $request)
    {
        TypeAdmDoc::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
