<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserparamRequest;
use App\Http\Requests\StoreUserparamRequest;
use App\Http\Requests\UpdateUserparamRequest;
use App\Models\ParameterUserType;
use App\Models\User;
use App\Models\Userparam;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserparamController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('userparam_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Userparam::with(['user', 'parameterusertype'])->select(sprintf('%s.*', (new Userparam())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'userparam_show';
                $editGate = 'userparam_edit';
                $deleteGate = 'userparam_delete';
                $crudRoutePart = 'userparams';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('parameterusertype_intitule', function ($row) {
                return $row->parameterusertype ? $row->parameterusertype->intitule : '';
            });

            $table->editColumn('param_value', function ($row) {
                return $row->param_value ? $row->param_value : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'parameterusertype']);

            return $table->make(true);
        }

        return view('admin.userparams.index');
    }

    public function create()
    {
        abort_if(Gate::denies('userparam_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parameterusertypes = ParameterUserType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userparams.create', compact('parameterusertypes', 'users'));
    }

    public function store(StoreUserparamRequest $request)
    {
        $userparam = Userparam::create($request->all());

        return redirect()->route('admin.userparams.index');
    }

    public function edit(Userparam $userparam)
    {
        abort_if(Gate::denies('userparam_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $parameterusertypes = ParameterUserType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userparam->load('user', 'parameterusertype');

        return view('admin.userparams.edit', compact('parameterusertypes', 'userparam', 'users'));
    }

    public function update(UpdateUserparamRequest $request, Userparam $userparam)
    {
        $userparam->update($request->all());

        return redirect()->route('admin.userparams.index');
    }

    public function show(Userparam $userparam)
    {
        abort_if(Gate::denies('userparam_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userparam->load('user', 'parameterusertype');

        return view('admin.userparams.show', compact('userparam'));
    }

    public function destroy(Userparam $userparam)
    {
        abort_if(Gate::denies('userparam_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userparam->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserparamRequest $request)
    {
        Userparam::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
