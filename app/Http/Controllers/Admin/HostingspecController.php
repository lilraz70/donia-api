<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyHostingspecRequest;
use App\Http\Requests\StoreHostingspecRequest;
use App\Http\Requests\UpdateHostingspecRequest;
use App\Models\ConvenienceType;
use App\Models\Hostingspec;
use App\Models\Lodging;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HostingspecController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hostingspec_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Hostingspec::with(['lodging', 'conveniencetype'])->select(sprintf('%s.*', (new Hostingspec())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hostingspec_show';
                $editGate = 'hostingspec_edit';
                $deleteGate = 'hostingspec_delete';
                $crudRoutePart = 'hostingspecs';

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

            $table->addColumn('conveniencetype_intitule', function ($row) {
                return $row->conveniencetype ? $row->conveniencetype->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lodging', 'conveniencetype']);

            return $table->make(true);
        }

        $lodgings          = Lodging::get();
        $convenience_types = ConvenienceType::get();

        return view('admin.hostingspecs.index', compact('lodgings', 'convenience_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('hostingspec_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodgings = Lodging::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $conveniencetypes = ConvenienceType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hostingspecs.create', compact('conveniencetypes', 'lodgings'));
    }

    public function store(StoreHostingspecRequest $request)
    {
        $hostingspec = Hostingspec::create($request->all());

        return redirect()->route('admin.hostingspecs.index');
    }

    public function edit(Hostingspec $hostingspec)
    {
        abort_if(Gate::denies('hostingspec_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lodgings = Lodging::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $conveniencetypes = ConvenienceType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hostingspec->load('lodging', 'conveniencetype');

        return view('admin.hostingspecs.edit', compact('conveniencetypes', 'hostingspec', 'lodgings'));
    }

    public function update(UpdateHostingspecRequest $request, Hostingspec $hostingspec)
    {
        $hostingspec->update($request->all());

        return redirect()->route('admin.hostingspecs.index');
    }

    public function show(Hostingspec $hostingspec)
    {
        abort_if(Gate::denies('hostingspec_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingspec->load('lodging', 'conveniencetype');

        return view('admin.hostingspecs.show', compact('hostingspec'));
    }

    public function destroy(Hostingspec $hostingspec)
    {
        abort_if(Gate::denies('hostingspec_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hostingspec->delete();

        return back();
    }

    public function massDestroy(MassDestroyHostingspecRequest $request)
    {
        Hostingspec::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
