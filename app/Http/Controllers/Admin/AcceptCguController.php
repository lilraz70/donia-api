<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAcceptCguRequest;
use App\Http\Requests\StoreAcceptCguRequest;
use App\Http\Requests\UpdateAcceptCguRequest;
use App\Models\AcceptCgu;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AcceptCguController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('accept_cgu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AcceptCgu::with(['user'])->select(sprintf('%s.*', (new AcceptCgu())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'accept_cgu_show';
                $editGate = 'accept_cgu_edit';
                $deleteGate = 'accept_cgu_delete';
                $crudRoutePart = 'accept-cgus';

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
            $table->editColumn('deviceinfo', function ($row) {
                return $row->deviceinfo ? $row->deviceinfo : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.acceptCgus.index');
    }

    public function create()
    {
        abort_if(Gate::denies('accept_cgu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.acceptCgus.create', compact('users'));
    }

    public function store(StoreAcceptCguRequest $request)
    {
        $acceptCgu = AcceptCgu::create($request->all());

        return redirect()->route('admin.accept-cgus.index');
    }

    public function edit(AcceptCgu $acceptCgu)
    {
        abort_if(Gate::denies('accept_cgu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $acceptCgu->load('user');

        return view('admin.acceptCgus.edit', compact('acceptCgu', 'users'));
    }

    public function update(UpdateAcceptCguRequest $request, AcceptCgu $acceptCgu)
    {
        $acceptCgu->update($request->all());

        return redirect()->route('admin.accept-cgus.index');
    }

    public function show(AcceptCgu $acceptCgu)
    {
        abort_if(Gate::denies('accept_cgu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $acceptCgu->load('user');

        return view('admin.acceptCgus.show', compact('acceptCgu'));
    }

    public function destroy(AcceptCgu $acceptCgu)
    {
        abort_if(Gate::denies('accept_cgu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $acceptCgu->delete();

        return back();
    }

    public function massDestroy(MassDestroyAcceptCguRequest $request)
    {
        AcceptCgu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
