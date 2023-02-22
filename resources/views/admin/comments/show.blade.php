@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.comment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.id') }}
                        </th>
                        <td>
                            {{ $comment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.contenu') }}
                        </th>
                        <td>
                            {{ $comment->contenu }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.objecttype') }}
                        </th>
                        <td>
                            {{ $comment->objecttype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.areasofservice') }}
                        </th>
                        <td>
                            {{ $comment->areasofservice->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.objet') }}
                        </th>
                        <td>
                            {{ $comment->objet }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comment.fields.user') }}
                        </th>
                        <td>
                            {{ $comment->user->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection