<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserserviceRequest;
use App\Http\Requests\StoreUserserviceRequest;
use App\Http\Requests\UpdateUserserviceRequest;
use App\Models\AreasOfService;
use App\Models\User;
use App\Models\Userservice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserservicesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('userservice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Userservice::with(['user', 'areasofservice'])->select(sprintf('%s.*', (new Userservice())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'userservice_show';
                $editGate = 'userservice_edit';
                $deleteGate = 'userservice_delete';
                $crudRoutePart = 'userservices';

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

            $table->addColumn('areasofservice_intitule', function ($row) {
                return $row->areasofservice ? $row->areasofservice->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'areasofservice']);

            return $table->make(true);
        }

        $users             = User::get();
        $areas_of_services = AreasOfService::get();

        return view('admin.userservices.index', compact('users', 'areas_of_services'));
    }

    public function create()
    {
        abort_if(Gate::denies('userservice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areasofservices = AreasOfService::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userservices.create', compact('areasofservices', 'users'));
    }

    public function store(StoreUserserviceRequest $request)
    {
        $userservice = Userservice::create($request->all());

        return redirect()->route('admin.userservices.index');
    }

    public function edit(Userservice $userservice)
    {
        abort_if(Gate::denies('userservice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areasofservices = AreasOfService::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userservice->load('user', 'areasofservice');

        return view('admin.userservices.edit', compact('areasofservices', 'users', 'userservice'));
    }

    public function update(UpdateUserserviceRequest $request, Userservice $userservice)
    {
        $userservice->update($request->all());

        return redirect()->route('admin.userservices.index');
    }

    public function show(Userservice $userservice)
    {
        abort_if(Gate::denies('userservice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userservice->load('user', 'areasofservice');

        return view('admin.userservices.show', compact('userservice'));
    }

    public function destroy(Userservice $userservice)
    {
        abort_if(Gate::denies('userservice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userservice->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserserviceRequest $request)
    {
        Userservice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
