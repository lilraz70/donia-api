<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySignalerRequest;
use App\Http\Requests\StoreSignalerRequest;
use App\Http\Requests\UpdateSignalerRequest;
use App\Models\Objecttype;
use App\Models\Reason;
use App\Models\Signaler;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SignalerController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('signaler_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Signaler::with(['user', 'objecttype', 'reason'])->select(sprintf('%s.*', (new Signaler())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'signaler_show';
                $editGate = 'signaler_edit';
                $deleteGate = 'signaler_delete';
                $crudRoutePart = 'signalers';

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
            $table->editColumn('experience_utilisateur', function ($row) {
                return $row->experience_utilisateur ? $row->experience_utilisateur : '';
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

            $table->rawColumns(['actions', 'placeholder', 'user', 'objecttype', 'reason']);

            return $table->make(true);
        }

        $users       = User::get();
        $objecttypes = Objecttype::get();
        $reasons     = Reason::get();

        return view('admin.signalers.index', compact('users', 'objecttypes', 'reasons'));
    }

    public function create()
    {
        abort_if(Gate::denies('signaler_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reasons = Reason::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.signalers.create', compact('objecttypes', 'reasons', 'users'));
    }

    public function store(StoreSignalerRequest $request)
    {
        $signaler = Signaler::create($request->all());

        return redirect()->route('admin.signalers.index');
    }

    public function edit(Signaler $signaler)
    {
        abort_if(Gate::denies('signaler_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $reasons = Reason::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $signaler->load('user', 'objecttype', 'reason');

        return view('admin.signalers.edit', compact('objecttypes', 'reasons', 'signaler', 'users'));
    }

    public function update(UpdateSignalerRequest $request, Signaler $signaler)
    {
        $signaler->update($request->all());

        return redirect()->route('admin.signalers.index');
    }

    public function show(Signaler $signaler)
    {
        abort_if(Gate::denies('signaler_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signaler->load('user', 'objecttype', 'reason');

        return view('admin.signalers.show', compact('signaler'));
    }

    public function destroy(Signaler $signaler)
    {
        abort_if(Gate::denies('signaler_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $signaler->delete();

        return back();
    }

    public function massDestroy(MassDestroySignalerRequest $request)
    {
        Signaler::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
