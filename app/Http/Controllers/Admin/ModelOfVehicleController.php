<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyModelOfVehicleRequest;
use App\Http\Requests\StoreModelOfVehicleRequest;
use App\Http\Requests\UpdateModelOfVehicleRequest;
use App\Models\Brand;
use App\Models\ModelOfVehicle;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ModelOfVehicleController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('model_of_vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ModelOfVehicle::with(['brand'])->select(sprintf('%s.*', (new ModelOfVehicle())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'model_of_vehicle_show';
                $editGate = 'model_of_vehicle_edit';
                $deleteGate = 'model_of_vehicle_delete';
                $crudRoutePart = 'model-of-vehicles';

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
            $table->addColumn('brand_intitule', function ($row) {
                return $row->brand ? $row->brand->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'brand']);

            return $table->make(true);
        }

        $brands = Brand::get();

        return view('admin.modelOfVehicles.index', compact('brands'));
    }

    public function create()
    {
        abort_if(Gate::denies('model_of_vehicle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.modelOfVehicles.create', compact('brands'));
    }

    public function store(StoreModelOfVehicleRequest $request)
    {
        $modelOfVehicle = ModelOfVehicle::create($request->all());

        return redirect()->route('admin.model-of-vehicles.index');
    }

    public function edit(ModelOfVehicle $modelOfVehicle)
    {
        abort_if(Gate::denies('model_of_vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $modelOfVehicle->load('brand');

        return view('admin.modelOfVehicles.edit', compact('brands', 'modelOfVehicle'));
    }

    public function update(UpdateModelOfVehicleRequest $request, ModelOfVehicle $modelOfVehicle)
    {
        $modelOfVehicle->update($request->all());

        return redirect()->route('admin.model-of-vehicles.index');
    }

    public function show(ModelOfVehicle $modelOfVehicle)
    {
        abort_if(Gate::denies('model_of_vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modelOfVehicle->load('brand');

        return view('admin.modelOfVehicles.show', compact('modelOfVehicle'));
    }

    public function destroy(ModelOfVehicle $modelOfVehicle)
    {
        abort_if(Gate::denies('model_of_vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $modelOfVehicle->delete();

        return back();
    }

    public function massDestroy(MassDestroyModelOfVehicleRequest $request)
    {
        ModelOfVehicle::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
