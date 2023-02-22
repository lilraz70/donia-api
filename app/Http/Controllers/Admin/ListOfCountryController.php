<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyListOfCountryRequest;
use App\Http\Requests\StoreListOfCountryRequest;
use App\Http\Requests\UpdateListOfCountryRequest;
use App\Models\ListOfCountry;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ListOfCountryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('list_of_country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ListOfCountry::query()->select(sprintf('%s.*', (new ListOfCountry())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'list_of_country_show';
                $editGate = 'list_of_country_edit';
                $deleteGate = 'list_of_country_delete';
                $crudRoutePart = 'list-of-countries';

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

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.listOfCountries.index');
    }

    public function create()
    {
        abort_if(Gate::denies('list_of_country_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.listOfCountries.create');
    }

    public function store(StoreListOfCountryRequest $request)
    {
        $listOfCountry = ListOfCountry::create($request->all());

        return redirect()->route('admin.list-of-countries.index');
    }

    public function edit(ListOfCountry $listOfCountry)
    {
        abort_if(Gate::denies('list_of_country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.listOfCountries.edit', compact('listOfCountry'));
    }

    public function update(UpdateListOfCountryRequest $request, ListOfCountry $listOfCountry)
    {
        $listOfCountry->update($request->all());

        return redirect()->route('admin.list-of-countries.index');
    }

    public function show(ListOfCountry $listOfCountry)
    {
        abort_if(Gate::denies('list_of_country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.listOfCountries.show', compact('listOfCountry'));
    }

    public function destroy(ListOfCountry $listOfCountry)
    {
        abort_if(Gate::denies('list_of_country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listOfCountry->delete();

        return back();
    }

    public function massDestroy(MassDestroyListOfCountryRequest $request)
    {
        ListOfCountry::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
