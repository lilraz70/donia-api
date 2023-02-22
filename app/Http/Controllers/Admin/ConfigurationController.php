<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyConfigurationRequest;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use App\Models\Configuration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ConfigurationController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('configuration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Configuration::query()->select(sprintf('%s.*', (new Configuration())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'configuration_show';
                $editGate = 'configuration_edit';
                $deleteGate = 'configuration_delete';
                $crudRoutePart = 'configurations';

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
            $table->editColumn('cle', function ($row) {
                return $row->cle ? $row->cle : '';
            });
            $table->editColumn('valeur', function ($row) {
                return $row->valeur ? $row->valeur : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.configurations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('configuration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configurations.create');
    }

    public function store(StoreConfigurationRequest $request)
    {
        $configuration = Configuration::create($request->all());

        return redirect()->route('admin.configurations.index');
    }

    public function edit(Configuration $configuration)
    {
        abort_if(Gate::denies('configuration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configurations.edit', compact('configuration'));
    }

    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->update($request->all());

        return redirect()->route('admin.configurations.index');
    }

    public function show(Configuration $configuration)
    {
        abort_if(Gate::denies('configuration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.configurations.show', compact('configuration'));
    }

    public function destroy(Configuration $configuration)
    {
        abort_if(Gate::denies('configuration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configuration->delete();

        return back();
    }

    public function massDestroy(MassDestroyConfigurationRequest $request)
    {
        Configuration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
