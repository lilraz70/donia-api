<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmergencyLevelRequest;
use App\Http\Requests\StoreEmergencyLevelRequest;
use App\Http\Requests\UpdateEmergencyLevelRequest;
use App\Models\EmergencyLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EmergencyLevelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('emergency_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EmergencyLevel::query()->select(sprintf('%s.*', (new EmergencyLevel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'emergency_level_show';
                $editGate = 'emergency_level_edit';
                $deleteGate = 'emergency_level_delete';
                $crudRoutePart = 'emergency-levels';

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

        return view('admin.emergencyLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('emergency_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emergencyLevels.create');
    }

    public function store(StoreEmergencyLevelRequest $request)
    {
        $emergencyLevel = EmergencyLevel::create($request->all());

        return redirect()->route('admin.emergency-levels.index');
    }

    public function edit(EmergencyLevel $emergencyLevel)
    {
        abort_if(Gate::denies('emergency_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emergencyLevels.edit', compact('emergencyLevel'));
    }

    public function update(UpdateEmergencyLevelRequest $request, EmergencyLevel $emergencyLevel)
    {
        $emergencyLevel->update($request->all());

        return redirect()->route('admin.emergency-levels.index');
    }

    public function show(EmergencyLevel $emergencyLevel)
    {
        abort_if(Gate::denies('emergency_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.emergencyLevels.show', compact('emergencyLevel'));
    }

    public function destroy(EmergencyLevel $emergencyLevel)
    {
        abort_if(Gate::denies('emergency_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $emergencyLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmergencyLevelRequest $request)
    {
        EmergencyLevel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
