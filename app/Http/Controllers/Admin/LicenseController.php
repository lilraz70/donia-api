<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLicenseRequest;
use App\Http\Requests\StoreLicenseRequest;
use App\Http\Requests\UpdateLicenseRequest;
use App\Models\License;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LicenseController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('license_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = License::with(['user'])->select(sprintf('%s.*', (new License())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'license_show';
                $editGate = 'license_edit';
                $deleteGate = 'license_delete';
                $crudRoutePart = 'licenses';

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

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.licenses.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('license_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.licenses.create', compact('users'));
    }

    public function store(StoreLicenseRequest $request)
    {
        $license = License::create($request->all());

        return redirect()->route('admin.licenses.index');
    }

    public function edit(License $license)
    {
        abort_if(Gate::denies('license_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $license->load('user');

        return view('admin.licenses.edit', compact('license', 'users'));
    }

    public function update(UpdateLicenseRequest $request, License $license)
    {
        $license->update($request->all());

        return redirect()->route('admin.licenses.index');
    }

    public function show(License $license)
    {
        abort_if(Gate::denies('license_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $license->load('user');

        return view('admin.licenses.show', compact('license'));
    }

    public function destroy(License $license)
    {
        abort_if(Gate::denies('license_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $license->delete();

        return back();
    }

    public function massDestroy(MassDestroyLicenseRequest $request)
    {
        License::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
