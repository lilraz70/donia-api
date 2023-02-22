<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHostingTypeRequest;
use App\Http\Requests\StoreHostingTypeRequest;
use App\Http\Requests\UpdateHostingTypeRequest;
use App\Models\HostingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HostingTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hosting_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HostingType::query()->select(sprintf('%s.*', (new HostingType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hosting_type_show';
                $editGate = 'hosting_type_edit';
                $deleteGate = 'hosting_type_delete';
                $crudRoutePart = 'hosting-types';

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

        return view('admin.hostingTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('hosting_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hostingTypes.create');
    }

    public function store(StoreHostingTypeRequest $request)
    {
        $hostingType = HostingType::create($request->all());

        return redirect()->route('admin.hosting-types.index');
    }

    public function edit(HostingType $hostingType)
    {
        abort_if(Gate::denies('hosting_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hostingTypes.edit', compact('hostingType'));
    }

    public function update(UpdateHostingTypeRequest $request, HostingType $hostingType)
    {
        $hostingType->update($request->all());

        return redirect()->route('admin.hosting-types.index');
    }

    public function show(HostingType $hostingType)
    {
        abort_if(Gate::denies('hosting_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.hostingTypes.show', compact('hostingType'));
    }

    public function destroy(HostingType $hostingType)
    {
        abort_if(Gate::denies('hosting_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingType->delete();

        return back();
    }

    public function massDestroy(MassDestroyHostingTypeRequest $request)
    {
        HostingType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
