<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyApproveRequest;
use App\Http\Requests\StoreApproveRequest;
use App\Http\Requests\UpdateApproveRequest;
use App\Models\Approve;
use App\Models\Objecttype;
use App\Models\Reason;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ApproveController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('approve_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Approve::with(['user', 'objecttype', 'reason'])->select(sprintf('%s.*', (new Approve())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'approve_show';
                $editGate = 'approve_edit';
                $deleteGate = 'approve_delete';
                $crudRoutePart = 'approves';

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
            $table->editColumn('comment', function ($row) {
                return $row->comment ? $row->comment : '';
            });
            $table->editColumn('objet', function ($row) {
                return $row->objet ? $row->objet : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('objecttype_intitule', function ($row) {
                return $row->objecttype ? $row->objecttype->intitule : '';
            });

            $table->addColumn('reason_intitule', function ($row) {
                return $row->reason ? $row->reason->intitule : '';
            });

            $table->editColumn('resultat', function ($row) {
                return $row->resultat ? $row->resultat : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'objecttype', 'reason']);

            return $table->make(true);
        }

        $users       = User::get();
        $objecttypes = Objecttype::get();
        $reasons     = Reason::get();

        return view('admin.approves.index', compact('users', 'objecttypes', 'reasons'));
    }

    public function create()
    {
        abort_if(Gate::denies('approve_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reasons = Reason::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.approves.create', compact('objecttypes', 'reasons', 'users'));
    }

    public function store(StoreApproveRequest $request)
    {
        $approve = Approve::create($request->all());

        return redirect()->route('admin.approves.index');
    }

    public function edit(Approve $approve)
    {
        abort_if(Gate::denies('approve_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reasons = Reason::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $approve->load('user', 'objecttype', 'reason');

        return view('admin.approves.edit', compact('approve', 'objecttypes', 'reasons', 'users'));
    }

    public function update(UpdateApproveRequest $request, Approve $approve)
    {
        $approve->update($request->all());

        return redirect()->route('admin.approves.index');
    }

    public function show(Approve $approve)
    {
        abort_if(Gate::denies('approve_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approve->load('user', 'objecttype', 'reason');

        return view('admin.approves.show', compact('approve'));
    }

    public function destroy(Approve $approve)
    {
        abort_if(Gate::denies('approve_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $approve->delete();

        return back();
    }

    public function massDestroy(MassDestroyApproveRequest $request)
    {
        Approve::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
