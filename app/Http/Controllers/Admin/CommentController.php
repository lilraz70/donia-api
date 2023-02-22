<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\AreasOfService;
use App\Models\Comment;
use App\Models\Objecttype;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comment::with(['objecttype', 'areasofservice', 'user'])->select(sprintf('%s.*', (new Comment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'comment_show';
                $editGate = 'comment_edit';
                $deleteGate = 'comment_delete';
                $crudRoutePart = 'comments';

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
            $table->editColumn('contenu', function ($row) {
                return $row->contenu ? $row->contenu : '';
            });
            $table->addColumn('objecttype_intitule', function ($row) {
                return $row->objecttype ? $row->objecttype->intitule : '';
            });

            $table->addColumn('areasofservice_intitule', function ($row) {
                return $row->areasofservice ? $row->areasofservice->intitule : '';
            });

            $table->editColumn('objet', function ($row) {
                return $row->objet ? $row->objet : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'objecttype', 'areasofservice', 'user']);

            return $table->make(true);
        }

        $objecttypes       = Objecttype::get();
        $areas_of_services = AreasOfService::get();
        $users             = User::get();

        return view('admin.comments.index', compact('objecttypes', 'areas_of_services', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areasofservices = AreasOfService::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.comments.create', compact('areasofservices', 'objecttypes', 'users'));
    }

    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());

        return redirect()->route('admin.comments.index');
    }

    public function edit(Comment $comment)
    {
        abort_if(Gate::denies('comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $objecttypes = Objecttype::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areasofservices = AreasOfService::pluck('intitule', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comment->load('objecttype', 'areasofservice', 'user');

        return view('admin.comments.edit', compact('areasofservices', 'comment', 'objecttypes', 'users'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        return redirect()->route('admin.comments.index');
    }

    public function show(Comment $comment)
    {
        abort_if(Gate::denies('comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->load('objecttype', 'areasofservice', 'user');

        return view('admin.comments.show', compact('comment'));
    }

    public function destroy(Comment $comment)
    {
        abort_if(Gate::denies('comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comment->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommentRequest $request)
    {
        Comment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
