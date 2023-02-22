<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyParameterUserTypeRequest;
use App\Http\Requests\StoreParameterUserTypeRequest;
use App\Http\Requests\UpdateParameterUserTypeRequest;
use App\Models\ParameterUserType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ParameterUserTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('parameter_user_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ParameterUserType::query()->select(sprintf('%s.*', (new ParameterUserType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'parameter_user_type_show';
                $editGate = 'parameter_user_type_edit';
                $deleteGate = 'parameter_user_type_delete';
                $crudRoutePart = 'parameter-user-types';

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

        return view('admin.parameterUserTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('parameter_user_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parameterUserTypes.create');
    }

    public function store(StoreParameterUserTypeRequest $request)
    {
        $parameterUserType = ParameterUserType::create($request->all());

        return redirect()->route('admin.parameter-user-types.index');
    }

    public function edit(ParameterUserType $parameterUserType)
    {
        abort_if(Gate::denies('parameter_user_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parameterUserTypes.edit', compact('parameterUserType'));
    }

    public function update(UpdateParameterUserTypeRequest $request, ParameterUserType $parameterUserType)
    {
        $parameterUserType->update($request->all());

        return redirect()->route('admin.parameter-user-types.index');
    }

    public function show(ParameterUserType $parameterUserType)
    {
        abort_if(Gate::denies('parameter_user_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.parameterUserTypes.show', compact('parameterUserType'));
    }

    public function destroy(ParameterUserType $parameterUserType)
    {
        abort_if(Gate::denies('parameter_user_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parameterUserType->delete();

        return back();
    }

    public function massDestroy(MassDestroyParameterUserTypeRequest $request)
    {
        ParameterUserType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
