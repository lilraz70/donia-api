<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFavoriRequest;
use App\Http\Requests\StoreFavoriRequest;
use App\Http\Requests\UpdateFavoriRequest;
use App\Models\Favori;
use App\Models\Objecttype;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavorisController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('favori_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $favoris = Favori::with(['objecttype'])->get();

        $objecttypes = Objecttype::get();

        return view('admin.favoris.index', compact('favoris', 'objecttypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('favori_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.favoris.create', compact('objecttypes'));
    }

    public function store(StoreFavoriRequest $request)
    {
        $favori = Favori::create($request->all());

        return redirect()->route('admin.favoris.index');
    }

    public function edit(Favori $favori)
    {
        abort_if(Gate::denies('favori_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $favori->load('objecttype');

        return view('admin.favoris.edit', compact('favori', 'objecttypes'));
    }

    public function update(UpdateFavoriRequest $request, Favori $favori)
    {
        $favori->update($request->all());

        return redirect()->route('admin.favoris.index');
    }

    public function show(Favori $favori)
    {
        abort_if(Gate::denies('favori_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $favori->load('objecttype');

        return view('admin.favoris.show', compact('favori'));
    }

    public function destroy(Favori $favori)
    {
        abort_if(Gate::denies('favori_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $favori->delete();

        return back();
    }

    public function massDestroy(MassDestroyFavoriRequest $request)
    {
        Favori::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
