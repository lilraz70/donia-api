<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyColorTypeRequest;
use App\Http\Requests\StoreColorTypeRequest;
use App\Http\Requests\UpdateColorTypeRequest;
use App\Models\ColorType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ColorTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('color_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ColorType::query()->select(sprintf('%s.*', (new ColorType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'color_type_show';
                $editGate = 'color_type_edit';
                $deleteGate = 'color_type_delete';
                $crudRoutePart = 'color-types';

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

        return view('admin.colorTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('color_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.colorTypes.create');
    }

    public function store(StoreColorTypeRequest $request)
    {
        $colorType = ColorType::create($request->all());

        return redirect()->route('admin.color-types.index');
    }

    public function edit(ColorType $colorType)
    {
        abort_if(Gate::denies('color_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.colorTypes.edit', compact('colorType'));
    }

    public function update(UpdateColorTypeRequest $request, ColorType $colorType)
    {
        $colorType->update($request->all());

        return redirect()->route('admin.color-types.index');
    }

    public function show(ColorType $colorType)
    {
        abort_if(Gate::denies('color_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.colorTypes.show', compact('colorType'));
    }

    public function destroy(ColorType $colorType)
    {
        abort_if(Gate::denies('color_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colorType->delete();

        return back();
    }

    public function massDestroy(MassDestroyColorTypeRequest $request)
    {
        ColorType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
