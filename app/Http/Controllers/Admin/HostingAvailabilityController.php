<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lodging;
use Illuminate\Http\Request;
use App\Models\HostingAvailability;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\StoreHostingAvailabilityRequest;
use App\Http\Requests\UpdateHostingAvailabilityRequest;
use App\Http\Requests\MassDestroyHostingAvailabilityRequest;

class HostingAvailabilityController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hosting_availability_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HostingAvailability::with(['lodging'])->select(sprintf('%s.*', (new HostingAvailability())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hosting_availability_show';
                $editGate = 'hosting_availability_edit';
                $deleteGate = 'hosting_availability_delete';
                $crudRoutePart = 'hosting-availabilities';

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

            $table->editColumn('heure_debut', function ($row) {
                return $row->heure_debut ? $row->heure_debut : '';
            });

            $table->editColumn('heure_fin', function ($row) {
                return $row->heure_fin ? $row->heure_fin : '';
            });
            $table->addColumn('lodging_libelle', function ($row) {
                return $row->lodging ? $row->lodging->libelle : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lodging']);

            return $table->make(true);
        }

        $lodgings = Lodging::get();

        return view('admin.hostingAvailabilities.index', compact('lodgings'));
    }

    public function create()
    {
        abort_if(Gate::denies('hosting_availability_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodgings = Lodging::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hostingAvailabilities.create', compact('lodgings'));
    }

    public function store(StoreHostingAvailabilityRequest $request)
    {
        $hostingAvailability = HostingAvailability::create($request->all());

        return redirect()->route('admin.hosting-availabilities.index');
    }

    public function edit(HostingAvailability $hostingAvailability)
    {
        abort_if(Gate::denies('hosting_availability_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodgings = Lodging::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hostingAvailability->load('lodging');

        return view('admin.hostingAvailabilities.edit', compact('hostingAvailability', 'lodgings'));
    }

    public function update(UpdateHostingAvailabilityRequest $request, HostingAvailability $hostingAvailability)
    {
        $hostingAvailability->update($request->all());

        return redirect()->route('admin.hosting-availabilities.index');
    }

    public function show(HostingAvailability $hostingAvailability)
    {
        abort_if(Gate::denies('hosting_availability_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingAvailability->load('lodging');

        return view('admin.hostingAvailabilities.show', compact('hostingAvailability'));
    }

    public function destroy(HostingAvailability $hostingAvailability)
    {
        abort_if(Gate::denies('hosting_availability_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingAvailability->delete();

        return back();
    }

    public function massDestroy(MassDestroyHostingAvailabilityRequest $request)
    {
        HostingAvailability::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
