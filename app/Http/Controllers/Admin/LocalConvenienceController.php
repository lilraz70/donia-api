<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLocalConvenienceRequest;
use App\Http\Requests\StoreLocalConvenienceRequest;
use App\Http\Requests\UpdateLocalConvenienceRequest;
use App\Models\ConvenienceType;
use App\Models\Local;
use App\Models\LocalConvenience;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocalConvenienceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('local_convenience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LocalConvenience::with(['local', 'conveniencetype'])->select(sprintf('%s.*', (new LocalConvenience())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'local_convenience_show';
                $editGate = 'local_convenience_edit';
                $deleteGate = 'local_convenience_delete';
                $crudRoutePart = 'local-conveniences';

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
            $table->addColumn('local_libelle', function ($row) {
                return $row->local ? $row->local->libelle : '';
            });

            $table->editColumn('local.description', function ($row) {
                return $row->local ? (is_string($row->local) ? $row->local : $row->local->description) : '';
            });
            $table->addColumn('conveniencetype_intitule', function ($row) {
                return $row->conveniencetype ? $row->conveniencetype->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'local', 'conveniencetype']);

            return $table->make(true);
        }

        $locals            = Local::get();
        $convenience_types = ConvenienceType::get();

        return view('admin.localConveniences.index', compact('locals', 'convenience_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('local_convenience_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locals = Local::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $conveniencetypes = ConvenienceType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.localConveniences.create', compact('conveniencetypes', 'locals'));
    }

    public function store(StoreLocalConvenienceRequest $request)
    {
        $localConvenience = LocalConvenience::create($request->all());

        return redirect()->route('admin.local-conveniences.index');
    }

    public function edit(LocalConvenience $localConvenience)
    {
        abort_if(Gate::denies('local_convenience_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locals = Local::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $conveniencetypes = ConvenienceType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $localConvenience->load('local', 'conveniencetype');

        return view('admin.localConveniences.edit', compact('conveniencetypes', 'localConvenience', 'locals'));
    }

    public function update(UpdateLocalConvenienceRequest $request, LocalConvenience $localConvenience)
    {
        $localConvenience->update($request->all());

        return redirect()->route('admin.local-conveniences.index');
    }

    public function show(LocalConvenience $localConvenience)
    {
        abort_if(Gate::denies('local_convenience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localConvenience->load('local', 'conveniencetype');

        return view('admin.localConveniences.show', compact('localConvenience'));
    }

    public function destroy(LocalConvenience $localConvenience)
    {
        abort_if(Gate::denies('local_convenience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $localConvenience->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocalConvenienceRequest $request)
    {
        LocalConvenience::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
