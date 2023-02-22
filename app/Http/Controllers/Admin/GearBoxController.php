<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyGearBoxRequest;
use App\Http\Requests\StoreGearBoxRequest;
use App\Http\Requests\UpdateGearBoxRequest;
use App\Models\GearBox;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class GearBoxController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('gear_box_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GearBox::query()->select(sprintf('%s.*', (new GearBox())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'gear_box_show';
                $editGate = 'gear_box_edit';
                $deleteGate = 'gear_box_delete';
                $crudRoutePart = 'gear-boxes';

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

        return view('admin.gearBoxes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('gear_box_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gearBoxes.create');
    }

    public function store(StoreGearBoxRequest $request)
    {
        $gearBox = GearBox::create($request->all());

        return redirect()->route('admin.gear-boxes.index');
    }

    public function edit(GearBox $gearBox)
    {
        abort_if(Gate::denies('gear_box_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gearBoxes.edit', compact('gearBox'));
    }

    public function update(UpdateGearBoxRequest $request, GearBox $gearBox)
    {
        $gearBox->update($request->all());

        return redirect()->route('admin.gear-boxes.index');
    }

    public function show(GearBox $gearBox)
    {
        abort_if(Gate::denies('gear_box_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gearBoxes.show', compact('gearBox'));
    }

    public function destroy(GearBox $gearBox)
    {
        abort_if(Gate::denies('gear_box_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gearBox->delete();

        return back();
    }

    public function massDestroy(MassDestroyGearBoxRequest $request)
    {
        GearBox::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
