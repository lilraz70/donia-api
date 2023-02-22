<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRatingTypeRequest;
use App\Http\Requests\StoreRatingTypeRequest;
use App\Http\Requests\UpdateRatingTypeRequest;
use App\Models\RatingType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RatingTypeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('rating_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RatingType::query()->select(sprintf('%s.*', (new RatingType())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rating_type_show';
                $editGate = 'rating_type_edit';
                $deleteGate = 'rating_type_delete';
                $crudRoutePart = 'rating-types';

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

        return view('admin.ratingTypes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('rating_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ratingTypes.create');
    }

    public function store(StoreRatingTypeRequest $request)
    {
        $ratingType = RatingType::create($request->all());

        return redirect()->route('admin.rating-types.index');
    }

    public function edit(RatingType $ratingType)
    {
        abort_if(Gate::denies('rating_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ratingTypes.edit', compact('ratingType'));
    }

    public function update(UpdateRatingTypeRequest $request, RatingType $ratingType)
    {
        $ratingType->update($request->all());

        return redirect()->route('admin.rating-types.index');
    }

    public function show(RatingType $ratingType)
    {
        abort_if(Gate::denies('rating_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ratingTypes.show', compact('ratingType'));
    }

    public function destroy(RatingType $ratingType)
    {
        abort_if(Gate::denies('rating_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ratingType->delete();

        return back();
    }

    public function massDestroy(MassDestroyRatingTypeRequest $request)
    {
        RatingType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
