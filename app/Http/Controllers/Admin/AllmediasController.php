<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAllmediaRequest;
use App\Http\Requests\StoreAllmediaRequest;
use App\Http\Requests\UpdateAllmediaRequest;
use App\Models\Allmedia;
use App\Models\Objecttype;
use App\Models\TypeOfMedium;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AllmediasController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('allmedia_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Allmedia::with(['objecttype', 'typeofmedia'])->select(sprintf('%s.*', (new Allmedia())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'allmedia_show';
                $editGate = 'allmedia_edit';
                $deleteGate = 'allmedia_delete';
                $crudRoutePart = 'allmedias';

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
            $table->editColumn('lien_ressources', function ($row) {
                return $row->lien_ressources ? '<a href="' . $row->lien_ressources->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('etiquettes', function ($row) {
                return $row->etiquettes ? $row->etiquettes : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->addColumn('objecttype_intitule', function ($row) {
                return $row->objecttype ? $row->objecttype->intitule : '';
            });

            $table->addColumn('typeofmedia_intitule', function ($row) {
                return $row->typeofmedia ? $row->typeofmedia->intitule : '';
            });

            $table->editColumn('objet', function ($row) {
                return $row->objet ? $row->objet : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lien_ressources', 'objecttype', 'typeofmedia']);

            return $table->make(true);
        }

        $objecttypes   = Objecttype::get();
        $type_of_media = TypeOfMedium::get();

        return view('admin.allmedias.index', compact('objecttypes', 'type_of_media'));
    }

    public function create()
    {
        abort_if(Gate::denies('allmedia_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofmedia = TypeOfMedium::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.allmedias.create', compact('objecttypes', 'typeofmedia'));
    }

    public function store(StoreAllmediaRequest $request)
    {
        $allmedia = Allmedia::create($request->all());

        if ($request->input('lien_ressources', false)) {
            $allmedia->addMedia(storage_path('tmp/uploads/' . basename($request->input('lien_ressources'))))->toMediaCollection('lien_ressources');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $allmedia->id]);
        }

        return redirect()->route('admin.allmedias.index');
    }

    public function edit(Allmedia $allmedia)
    {
        abort_if(Gate::denies('allmedia_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $typeofmedia = TypeOfMedium::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $allmedia->load('objecttype', 'typeofmedia');

        return view('admin.allmedias.edit', compact('allmedia', 'objecttypes', 'typeofmedia'));
    }

    public function update(UpdateAllmediaRequest $request, Allmedia $allmedia)
    {
        $allmedia->update($request->all());

        if ($request->input('lien_ressources', false)) {
            if (!$allmedia->lien_ressources || $request->input('lien_ressources') !== $allmedia->lien_ressources->file_name) {
                if ($allmedia->lien_ressources) {
                    $allmedia->lien_ressources->delete();
                }
                $allmedia->addMedia(storage_path('tmp/uploads/' . basename($request->input('lien_ressources'))))->toMediaCollection('lien_ressources');
            }
        } elseif ($allmedia->lien_ressources) {
            $allmedia->lien_ressources->delete();
        }

        return redirect()->route('admin.allmedias.index');
    }

    public function show(Allmedia $allmedia)
    {
        abort_if(Gate::denies('allmedia_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allmedia->load('objecttype', 'typeofmedia');

        return view('admin.allmedias.show', compact('allmedia'));
    }

    public function destroy(Allmedia $allmedia)
    {
        abort_if(Gate::denies('allmedia_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $allmedia->delete();

        return back();
    }

    public function massDestroy(MassDestroyAllmediaRequest $request)
    {
        Allmedia::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('allmedia_create') && Gate::denies('allmedia_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Allmedia();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
