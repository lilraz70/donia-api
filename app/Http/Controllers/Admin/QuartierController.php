<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyQuartierRequest;
use App\Http\Requests\StoreQuartierRequest;
use App\Http\Requests\UpdateQuartierRequest;
use App\Models\City;
use App\Models\Quartier;
use App\Models\SetCountry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class QuartierController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('quartier_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Quartier::with(['set_countries', 'city'])->select(sprintf('%s.*', (new Quartier())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'quartier_show';
                $editGate = 'quartier_edit';
                $deleteGate = 'quartier_delete';
                $crudRoutePart = 'quartiers';

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
            $table->addColumn('set_countries_intitule', function ($row) {
                return $row->set_countries ? $row->set_countries->intitule : '';
            });

            $table->addColumn('city_intitule', function ($row) {
                return $row->city ? $row->city->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'set_countries', 'city']);

            return $table->make(true);
        }

        return view('admin.quartiers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('quartier_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $set_countries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.quartiers.create', compact('cities', 'set_countries'));
    }

    public function store(StoreQuartierRequest $request)
    {
        $quartier = Quartier::create($request->all());

        return redirect()->route('admin.quartiers.index');
    }

    public function edit(Quartier $quartier)
    {
        abort_if(Gate::denies('quartier_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $set_countries = SetCountry::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $quartier->load('set_countries', 'city');

        return view('admin.quartiers.edit', compact('cities', 'quartier', 'set_countries'));
    }

    public function update(UpdateQuartierRequest $request, Quartier $quartier)
    {
        $quartier->update($request->all());

        return redirect()->route('admin.quartiers.index');
    }

    public function show(Quartier $quartier)
    {
        abort_if(Gate::denies('quartier_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quartier->load('set_countries', 'city');

        return view('admin.quartiers.show', compact('quartier'));
    }

    public function destroy(Quartier $quartier)
    {
        abort_if(Gate::denies('quartier_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quartier->delete();

        return back();
    }

    public function massDestroy(MassDestroyQuartierRequest $request)
    {
        Quartier::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
