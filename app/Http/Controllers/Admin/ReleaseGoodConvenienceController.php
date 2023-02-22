<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReleaseGoodConvenienceRequest;
use App\Http\Requests\StoreReleaseGoodConvenienceRequest;
use App\Http\Requests\UpdateReleaseGoodConvenienceRequest;
use App\Models\ConvenienceType;
use App\Models\ReleaseGood;
use App\Models\ReleaseGoodConvenience;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReleaseGoodConvenienceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('release_good_convenience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ReleaseGoodConvenience::with(['releasegood', 'conveniencetype'])->select(sprintf('%s.*', (new ReleaseGoodConvenience())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'release_good_convenience_show';
                $editGate = 'release_good_convenience_edit';
                $deleteGate = 'release_good_convenience_delete';
                $crudRoutePart = 'release-good-conveniences';

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
            $table->addColumn('releasegood_libelle', function ($row) {
                return $row->releasegood ? $row->releasegood->libelle : '';
            });

            $table->addColumn('conveniencetype_intitule', function ($row) {
                return $row->conveniencetype ? $row->conveniencetype->intitule : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'releasegood', 'conveniencetype']);

            return $table->make(true);
        }

        $release_goods     = ReleaseGood::get();
        $convenience_types = ConvenienceType::get();

        return view('admin.releaseGoodConveniences.index', compact('release_goods', 'convenience_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('release_good_convenience_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releasegoods = ReleaseGood::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $conveniencetypes = ConvenienceType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.releaseGoodConveniences.create', compact('conveniencetypes', 'releasegoods'));
    }

    public function store(StoreReleaseGoodConvenienceRequest $request)
    {
        $releaseGoodConvenience = ReleaseGoodConvenience::create($request->all());

        return redirect()->route('admin.release-good-conveniences.index');
    }

    public function edit(ReleaseGoodConvenience $releaseGoodConvenience)
    {
        abort_if(Gate::denies('release_good_convenience_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releasegoods = ReleaseGood::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $conveniencetypes = ConvenienceType::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $releaseGoodConvenience->load('releasegood', 'conveniencetype');

        return view('admin.releaseGoodConveniences.edit', compact('conveniencetypes', 'releaseGoodConvenience', 'releasegoods'));
    }

    public function update(UpdateReleaseGoodConvenienceRequest $request, ReleaseGoodConvenience $releaseGoodConvenience)
    {
        $releaseGoodConvenience->update($request->all());

        return redirect()->route('admin.release-good-conveniences.index');
    }

    public function show(ReleaseGoodConvenience $releaseGoodConvenience)
    {
        abort_if(Gate::denies('release_good_convenience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releaseGoodConvenience->load('releasegood', 'conveniencetype');

        return view('admin.releaseGoodConveniences.show', compact('releaseGoodConvenience'));
    }

    public function destroy(ReleaseGoodConvenience $releaseGoodConvenience)
    {
        abort_if(Gate::denies('release_good_convenience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releaseGoodConvenience->delete();

        return back();
    }

    public function massDestroy(MassDestroyReleaseGoodConvenienceRequest $request)
    {
        ReleaseGoodConvenience::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
