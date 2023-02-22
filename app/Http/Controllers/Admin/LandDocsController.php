<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLandDocRequest;
use App\Http\Requests\StoreLandDocRequest;
use App\Http\Requests\UpdateLandDocRequest;
use App\Models\Land;
use App\Models\LandDoc;
use App\Models\TypeAdmDoc;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LandDocsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('land_doc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LandDoc::with(['land', 'typeadmdoc'])->select(sprintf('%s.*', (new LandDoc())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'land_doc_show';
                $editGate = 'land_doc_edit';
                $deleteGate = 'land_doc_delete';
                $crudRoutePart = 'land-docs';

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
            $table->addColumn('land_libelle', function ($row) {
                return $row->land ? $row->land->libelle : '';
            });

            $table->addColumn('typeadmdoc_intitule', function ($row) {
                return $row->typeadmdoc ? $row->typeadmdoc->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'land', 'typeadmdoc']);

            return $table->make(true);
        }

        $lands         = Land::get();
        $type_adm_docs = TypeAdmDoc::get();

        return view('admin.landDocs.index', compact('lands', 'type_adm_docs'));
    }

    public function create()
    {
        abort_if(Gate::denies('land_doc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lands = Land::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeadmdocs = TypeAdmDoc::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.landDocs.create', compact('lands', 'typeadmdocs'));
    }

    public function store(StoreLandDocRequest $request)
    {
        $landDoc = LandDoc::create($request->all());

        return redirect()->route('admin.land-docs.index');
    }

    public function edit(LandDoc $landDoc)
    {
        abort_if(Gate::denies('land_doc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lands = Land::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeadmdocs = TypeAdmDoc::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $landDoc->load('land', 'typeadmdoc');

        return view('admin.landDocs.edit', compact('landDoc', 'lands', 'typeadmdocs'));
    }

    public function update(UpdateLandDocRequest $request, LandDoc $landDoc)
    {
        $landDoc->update($request->all());

        return redirect()->route('admin.land-docs.index');
    }

    public function show(LandDoc $landDoc)
    {
        abort_if(Gate::denies('land_doc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landDoc->load('land', 'typeadmdoc');

        return view('admin.landDocs.show', compact('landDoc'));
    }

    public function destroy(LandDoc $landDoc)
    {
        abort_if(Gate::denies('land_doc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landDoc->delete();

        return back();
    }

    public function massDestroy(MassDestroyLandDocRequest $request)
    {
        LandDoc::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
