<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBookreleasegoodRequest;
use App\Http\Requests\StoreBookreleasegoodRequest;
use App\Http\Requests\UpdateBookreleasegoodRequest;
use App\Models\Bookreleasegood;
use App\Models\ReleaseGood;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookreleasegoodController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bookreleasegood_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookreleasegoods = Bookreleasegood::with(['releasegood', 'user'])->get();

        return view('admin.bookreleasegoods.index', compact('bookreleasegoods'));
    }

    public function create()
    {
        abort_if(Gate::denies('bookreleasegood_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releasegoods = ReleaseGood::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookreleasegoods.create', compact('releasegoods', 'users'));
    }

    public function store(StoreBookreleasegoodRequest $request)
    {
        $bookreleasegood = Bookreleasegood::create($request->all());

        return redirect()->route('admin.bookreleasegoods.index');
    }

    public function edit(Bookreleasegood $bookreleasegood)
    {
        abort_if(Gate::denies('bookreleasegood_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $releasegoods = ReleaseGood::pluck('libelle', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookreleasegood->load('releasegood', 'user');

        return view('admin.bookreleasegoods.edit', compact('bookreleasegood', 'releasegoods', 'users'));
    }

    public function update(UpdateBookreleasegoodRequest $request, Bookreleasegood $bookreleasegood)
    {
        $bookreleasegood->update($request->all());

        return redirect()->route('admin.bookreleasegoods.index');
    }

    public function show(Bookreleasegood $bookreleasegood)
    {
        abort_if(Gate::denies('bookreleasegood_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookreleasegood->load('releasegood', 'user');

        return view('admin.bookreleasegoods.show', compact('bookreleasegood'));
    }

    public function destroy(Bookreleasegood $bookreleasegood)
    {
        abort_if(Gate::denies('bookreleasegood_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookreleasegood->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookreleasegoodRequest $request)
    {
        Bookreleasegood::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
