<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTypeOfUtilityRequest;
use App\Http\Requests\StoreTypeOfUtilityRequest;
use App\Http\Requests\UpdateTypeOfUtilityRequest;
use App\Models\TypeOfUtility;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TypeOfUtilityController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('type_of_utility_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TypeOfUtility::query()->select(sprintf('%s.*', (new TypeOfUtility())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'type_of_utility_show';
                $editGate = 'type_of_utility_edit';
                $deleteGate = 'type_of_utility_delete';
                $crudRoutePart = 'type-of-utilities';

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

        return view('admin.typeOfUtilities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('type_of_utility_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfUtilities.create');
    }

    public function store(StoreTypeOfUtilityRequest $request)
    {
        $typeOfUtility = TypeOfUtility::create($request->all());

        return redirect()->route('admin.type-of-utilities.index');
    }

    public function edit(TypeOfUtility $typeOfUtility)
    {
        abort_if(Gate::denies('type_of_utility_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfUtilities.edit', compact('typeOfUtility'));
    }

    public function update(UpdateTypeOfUtilityRequest $request, TypeOfUtility $typeOfUtility)
    {
        $typeOfUtility->update($request->all());

        return redirect()->route('admin.type-of-utilities.index');
    }

    public function show(TypeOfUtility $typeOfUtility)
    {
        abort_if(Gate::denies('type_of_utility_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.typeOfUtilities.show', compact('typeOfUtility'));
    }

    public function destroy(TypeOfUtility $typeOfUtility)
    {
        abort_if(Gate::denies('type_of_utility_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $typeOfUtility->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeOfUtilityRequest $request)
    {
        TypeOfUtility::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
