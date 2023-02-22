<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAreasOfServiceRequest;
use App\Http\Requests\StoreAreasOfServiceRequest;
use App\Http\Requests\UpdateAreasOfServiceRequest;
use App\Models\AreasOfService;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AreasOfServiceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('areas_of_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AreasOfService::query()->select(sprintf('%s.*', (new AreasOfService())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'areas_of_service_show';
                $editGate = 'areas_of_service_edit';
                $deleteGate = 'areas_of_service_delete';
                $crudRoutePart = 'areas-of-services';

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

        return view('admin.areasOfServices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('areas_of_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.areasOfServices.create');
    }

    public function store(StoreAreasOfServiceRequest $request)
    {
        $areasOfService = AreasOfService::create($request->all());

        return redirect()->route('admin.areas-of-services.index');
    }

    public function edit(AreasOfService $areasOfService)
    {
        abort_if(Gate::denies('areas_of_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.areasOfServices.edit', compact('areasOfService'));
    }

    public function update(UpdateAreasOfServiceRequest $request, AreasOfService $areasOfService)
    {
        $areasOfService->update($request->all());

        return redirect()->route('admin.areas-of-services.index');
    }

    public function show(AreasOfService $areasOfService)
    {
        abort_if(Gate::denies('areas_of_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.areasOfServices.show', compact('areasOfService'));
    }

    public function destroy(AreasOfService $areasOfService)
    {
        abort_if(Gate::denies('areas_of_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areasOfService->delete();

        return back();
    }

    public function massDestroy(MassDestroyAreasOfServiceRequest $request)
    {
        AreasOfService::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
