<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySetCountryRequest;
use App\Http\Requests\StoreSetCountryRequest;
use App\Http\Requests\UpdateSetCountryRequest;
use App\Models\SetCountry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SetCountryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('set_country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SetCountry::query()->select(sprintf('%s.*', (new SetCountry())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'set_country_show';
                $editGate = 'set_country_edit';
                $deleteGate = 'set_country_delete';
                $crudRoutePart = 'set-countries';

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
            $table->editColumn('code', function ($row) {
                return $row->code ? $row->code : '';
            });
            $table->editColumn('prefix', function ($row) {
                return $row->prefix ? $row->prefix : '';
            });
            $table->editColumn('flag', function ($row) {
                return $row->flag ? $row->flag : '';
            });
            $table->editColumn('statut', function ($row) {
                return $row->statut ? SetCountry::STATUT_SELECT[$row->statut] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.setCountries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('set_country_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.setCountries.create');
    }

    public function store(StoreSetCountryRequest $request)
    {
        $setCountry = SetCountry::create($request->all());

        return redirect()->route('admin.set-countries.index');
    }

    public function edit(SetCountry $setCountry)
    {
        abort_if(Gate::denies('set_country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.setCountries.edit', compact('setCountry'));
    }

    public function update(UpdateSetCountryRequest $request, SetCountry $setCountry)
    {
        $setCountry->update($request->all());

        return redirect()->route('admin.set-countries.index');
    }

    public function show(SetCountry $setCountry)
    {
        abort_if(Gate::denies('set_country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setCountry->load('setCountriesCities');

        return view('admin.setCountries.show', compact('setCountry'));
    }

    public function destroy(SetCountry $setCountry)
    {
        abort_if(Gate::denies('set_country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setCountry->delete();

        return back();
    }

    public function massDestroy(MassDestroySetCountryRequest $request)
    {
        SetCountry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
