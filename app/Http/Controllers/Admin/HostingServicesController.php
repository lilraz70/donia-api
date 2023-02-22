<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHostingServiceRequest;
use App\Http\Requests\StoreHostingServiceRequest;
use App\Http\Requests\UpdateHostingServiceRequest;
use App\Models\HostingService;
use App\Models\Lodging;
use App\Models\Servicesinclu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HostingServicesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hosting_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HostingService::with(['lodging', 'servicesinclus'])->select(sprintf('%s.*', (new HostingService())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hosting_service_show';
                $editGate = 'hosting_service_edit';
                $deleteGate = 'hosting_service_delete';
                $crudRoutePart = 'hosting-services';

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
            $table->addColumn('lodging_libelle', function ($row) {
                return $row->lodging ? $row->lodging->libelle : '';
            });

            $table->addColumn('servicesinclus_intitule', function ($row) {
                return $row->servicesinclus ? $row->servicesinclus->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lodging', 'servicesinclus']);

            return $table->make(true);
        }

        $lodgings       = Lodging::get();
        $servicesinclus = Servicesinclu::get();

        return view('admin.hostingServices.index', compact('lodgings', 'servicesinclus'));
    }

    public function create()
    {
        abort_if(Gate::denies('hosting_service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodgings = Lodging::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $servicesincluses = Servicesinclu::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hostingServices.create', compact('lodgings', 'servicesincluses'));
    }

    public function store(StoreHostingServiceRequest $request)
    {
        $hostingService = HostingService::create($request->all());

        return redirect()->route('admin.hosting-services.index');
    }

    public function edit(HostingService $hostingService)
    {
        abort_if(Gate::denies('hosting_service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodgings = Lodging::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $servicesincluses = Servicesinclu::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hostingService->load('lodging', 'servicesinclus');

        return view('admin.hostingServices.edit', compact('hostingService', 'lodgings', 'servicesincluses'));
    }

    public function update(UpdateHostingServiceRequest $request, HostingService $hostingService)
    {
        $hostingService->update($request->all());

        return redirect()->route('admin.hosting-services.index');
    }

    public function show(HostingService $hostingService)
    {
        abort_if(Gate::denies('hosting_service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingService->load('lodging', 'servicesinclus');

        return view('admin.hostingServices.show', compact('hostingService'));
    }

    public function destroy(HostingService $hostingService)
    {
        abort_if(Gate::denies('hosting_service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingService->delete();

        return back();
    }

    public function massDestroy(MassDestroyHostingServiceRequest $request)
    {
        HostingService::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
