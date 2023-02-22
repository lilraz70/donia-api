<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTypeOfMediumRequest;
use App\Http\Requests\StoreTypeOfMediumRequest;
use App\Http\Requests\UpdateTypeOfMediumRequest;
use App\Models\TypeOfMedium;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TypeOfMediaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('type_of_medium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TypeOfMedium::query()->select(sprintf('%s.*', (new TypeOfMedium())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'type_of_medium_show';
                $editGate = 'type_of_medium_edit';
                $deleteGate = 'type_of_medium_delete';
                $crudRoutePart = 'type-of-media';

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

        return view('admin.typeOfMedia.index');
    }

    public function create()
    {
        abort_if(Gate::denies('type_of_medium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfMedia.create');
    }

    public function store(StoreTypeOfMediumRequest $request)
    {
        $typeOfMedium = TypeOfMedium::create($request->all());

        return redirect()->route('admin.type-of-media.index');
    }

    public function edit(TypeOfMedium $typeOfMedium)
    {
        abort_if(Gate::denies('type_of_medium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfMedia.edit', compact('typeOfMedium'));
    }

    public function update(UpdateTypeOfMediumRequest $request, TypeOfMedium $typeOfMedium)
    {
        $typeOfMedium->update($request->all());

        return redirect()->route('admin.type-of-media.index');
    }

    public function show(TypeOfMedium $typeOfMedium)
    {
        abort_if(Gate::denies('type_of_medium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfMedia.show', compact('typeOfMedium'));
    }

    public function destroy(TypeOfMedium $typeOfMedium)
    {
        abort_if(Gate::denies('type_of_medium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfMedium->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeOfMediumRequest $request)
    {
        TypeOfMedium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
