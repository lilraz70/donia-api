<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyConvenienceTypeRequest;
use App\Http\Requests\StoreConvenienceTypeRequest;
use App\Http\Requests\UpdateConvenienceTypeRequest;
use App\Models\ConvenienceType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ConvenienceTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('convenience_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ConvenienceType::query()->select(sprintf('%s.*', (new ConvenienceType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'convenience_type_show';
                $editGate = 'convenience_type_edit';
                $deleteGate = 'convenience_type_delete';
                $crudRoutePart = 'convenience-types';

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

        return view('admin.convenienceTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('convenience_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.convenienceTypes.create');
    }

    public function store(StoreConvenienceTypeRequest $request)
    {
        $convenienceType = ConvenienceType::create($request->all());

        return redirect()->route('admin.convenience-types.index');
    }

    public function edit(ConvenienceType $convenienceType)
    {
        abort_if(Gate::denies('convenience_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.convenienceTypes.edit', compact('convenienceType'));
    }

    public function update(UpdateConvenienceTypeRequest $request, ConvenienceType $convenienceType)
    {
        $convenienceType->update($request->all());

        return redirect()->route('admin.convenience-types.index');
    }

    public function show(ConvenienceType $convenienceType)
    {
        abort_if(Gate::denies('convenience_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.convenienceTypes.show', compact('convenienceType'));
    }

    public function destroy(ConvenienceType $convenienceType)
    {
        abort_if(Gate::denies('convenience_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $convenienceType->delete();

        return back();
    }

    public function massDestroy(MassDestroyConvenienceTypeRequest $request)
    {
        ConvenienceType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
