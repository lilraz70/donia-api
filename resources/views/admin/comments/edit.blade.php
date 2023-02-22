@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.comment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comments.update", [$comment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="contenu">{{ trans('cruds.comment.fields.contenu') }}</label>
                <input class="form-control {{ $errors->has('contenu') ? 'is-invalid' : '' }}" type="text" name="contenu" id="contenu" value="{{ old('contenu', $comment->contenu) }}" required>
                @if($errors->has('contenu'))
                    <span class="text-danger">{{ $errors->first('contenu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.contenu_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objecttype_id">{{ trans('cruds.comment.fields.objecttype') }}</label>
                <select class="form-control select2 {{ $errors->has('objecttype') ? 'is-invalid' : '' }}" name="objecttype_id" id="objecttype_id" required>
                    @foreach($objecttypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('objecttype_id') ? old('objecttype_id') : $comment->objecttype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('objecttype'))
                    <span class="text-danger">{{ $errors->first('objecttype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.objecttype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="areasofservice_id">{{ trans('cruds.comment.fields.areasofservice') }}</label>
                <select class="form-control select2 {{ $errors->has('areasofservice') ? 'is-invalid' : '' }}" name="areasofservice_id" id="areasofservice_id" required>
                    @foreach($areasofservices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('areasofservice_id') ? old('areasofservice_id') : $comment->areasofservice->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('areasofservice'))
                    <span class="text-danger">{{ $errors->first('areasofservice') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.areasofservice_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objet">{{ trans('cruds.comment.fields.objet') }}</label>
                <input class="form-control {{ $errors->has('objet') ? 'is-invalid' : '' }}" type="number" name="objet" id="objet" value="{{ old('objet', $comment->objet) }}" step="1" required>
                @if($errors->has('objet'))
                    <span class="text-danger">{{ $errors->first('objet') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.objet_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.comment.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $comment->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.comment.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection