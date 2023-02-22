<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLandCategoryRequest;
use App\Http\Requests\StoreLandCategoryRequest;
use App\Http\Requests\UpdateLandCategoryRequest;
use App\Models\LandCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LandCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('land_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LandCategory::query()->select(sprintf('%s.*', (new LandCategory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'land_category_show';
                $editGate = 'land_category_edit';
                $deleteGate = 'land_category_delete';
                $crudRoutePart = 'land-categories';

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

        return view('admin.landCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('land_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.landCategories.create');
    }

    public function store(StoreLandCategoryRequest $request)
    {
        $landCategory = LandCategory::create($request->all());

        return redirect()->route('admin.land-categories.index');
    }

    public function edit(LandCategory $landCategory)
    {
        abort_if(Gate::denies('land_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.landCategories.edit', compact('landCategory'));
    }

    public function update(UpdateLandCategoryRequest $request, LandCategory $landCategory)
    {
        $landCategory->update($request->all());

        return redirect()->route('admin.land-categories.index');
    }

    public function show(LandCategory $landCategory)
    {
        abort_if(Gate::denies('land_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.landCategories.show', compact('landCategory'));
    }

    public function destroy(LandCategory $landCategory)
    {
        abort_if(Gate::denies('land_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyLandCategoryRequest $request)
    {
        LandCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
