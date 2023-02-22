<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyServicesincluRequest;
use App\Http\Requests\StoreServicesincluRequest;
use App\Http\Requests\UpdateServicesincluRequest;
use App\Models\Servicesinclu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ServicesinclusController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('servicesinclu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Servicesinclu::query()->select(sprintf('%s.*', (new Servicesinclu())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'servicesinclu_show';
                $editGate = 'servicesinclu_edit';
                $deleteGate = 'servicesinclu_delete';
                $crudRoutePart = 'servicesinclus';

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

        return view('admin.servicesinclus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('servicesinclu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servicesinclus.create');
    }

    public function store(StoreServicesincluRequest $request)
    {
        $servicesinclu = Servicesinclu::create($request->all());

        return redirect()->route('admin.servicesinclus.index');
    }

    public function edit(Servicesinclu $servicesinclu)
    {
        abort_if(Gate::denies('servicesinclu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servicesinclus.edit', compact('servicesinclu'));
    }

    public function update(UpdateServicesincluRequest $request, Servicesinclu $servicesinclu)
    {
        $servicesinclu->update($request->all());

        return redirect()->route('admin.servicesinclus.index');
    }

    public function show(Servicesinclu $servicesinclu)
    {
        abort_if(Gate::denies('servicesinclu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servicesinclus.show', compact('servicesinclu'));
    }

    public function destroy(Servicesinclu $servicesinclu)
    {
        abort_if(Gate::denies('servicesinclu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicesinclu->delete();

        return back();
    }

    public function massDestroy(MassDestroyServicesincluRequest $request)
    {
        Servicesinclu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
