<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRatingRequest;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\AreasOfService;
use App\Models\Objecttype;
use App\Models\Rating;
use App\Models\RatingType;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RatingsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('rating_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Rating::with(['areasofservices', 'objecttype', 'user', 'ratingtype'])->select(sprintf('%s.*', (new Rating())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rating_show';
                $editGate = 'rating_edit';
                $deleteGate = 'rating_delete';
                $crudRoutePart = 'ratings';

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
            $table->addColumn('areasofservices_intitule', function ($row) {
                return $row->areasofservices ? $row->areasofservices->intitule : '';
            });

            $table->addColumn('objecttype_intitule', function ($row) {
                return $row->objecttype ? $row->objecttype->intitule : '';
            });

            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('ratingtype_intitule', function ($row) {
                return $row->ratingtype ? $row->ratingtype->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'areasofservices', 'objecttype', 'user', 'ratingtype']);

            return $table->make(true);
        }

        $areas_of_services = AreasOfService::get();
        $objecttypes       = Objecttype::get();
        $users             = User::get();
        $rating_types      = RatingType::get();

        return view('admin.ratings.index', compact('areas_of_services', 'objecttypes', 'users', 'rating_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('rating_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areasofservices = AreasOfService::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ratingtypes = RatingType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ratings.create', compact('areasofservices', 'objecttypes', 'ratingtypes', 'users'));
    }

    public function store(StoreRatingRequest $request)
    {
        $rating = Rating::create($request->all());

        return redirect()->route('admin.ratings.index');
    }

    public function edit(Rating $rating)
    {
        abort_if(Gate::denies('rating_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areasofservices = AreasOfService::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ratingtypes = RatingType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rating->load('areasofservices', 'objecttype', 'user', 'ratingtype');

        return view('admin.ratings.edit', compact('areasofservices', 'objecttypes', 'rating', 'ratingtypes', 'users'));
    }

    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        $rating->update($request->all());

        return redirect()->route('admin.ratings.index');
    }

    public function show(Rating $rating)
    {
        abort_if(Gate::denies('rating_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rating->load('areasofservices', 'objecttype', 'user', 'ratingtype');

        return view('admin.ratings.show', compact('rating'));
    }

    public function destroy(Rating $rating)
    {
        abort_if(Gate::denies('rating_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rating->delete();

        return back();
    }

    public function massDestroy(MassDestroyRatingRequest $request)
    {
        Rating::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
