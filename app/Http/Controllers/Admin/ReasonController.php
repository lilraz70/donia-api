<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReasonRequest;
use App\Http\Requests\StoreReasonRequest;
use App\Http\Requests\UpdateReasonRequest;
use App\Models\Reason;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReasonController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('reason_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Reason::query()->select(sprintf('%s.*', (new Reason())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'reason_show';
                $editGate = 'reason_edit';
                $deleteGate = 'reason_delete';
                $crudRoutePart = 'reasons';

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

        return view('admin.reasons.index');
    }

    public function create()
    {
        abort_if(Gate::denies('reason_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reasons.create');
    }

    public function store(StoreReasonRequest $request)
    {
        $reason = Reason::create($request->all());

        return redirect()->route('admin.reasons.index');
    }

    public function edit(Reason $reason)
    {
        abort_if(Gate::denies('reason_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reasons.edit', compact('reason'));
    }

    public function update(UpdateReasonRequest $request, Reason $reason)
    {
        $reason->update($request->all());

        return redirect()->route('admin.reasons.index');
    }

    public function show(Reason $reason)
    {
        abort_if(Gate::denies('reason_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reasons.show', compact('reason'));
    }

    public function destroy(Reason $reason)
    {
        abort_if(Gate::denies('reason_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reason->delete();

        return back();
    }

    public function massDestroy(MassDestroyReasonRequest $request)
    {
        Reason::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
