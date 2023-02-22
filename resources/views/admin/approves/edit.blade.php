@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.approve.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.approves.update", [$approve->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="comment">{{ trans('cruds.approve.fields.comment') }}</label>
                <input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment" id="comment" value="{{ old('comment', $approve->comment) }}" required>
                @if($errors->has('comment'))
                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.approve.fields.comment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objet">{{ trans('cruds.approve.fields.objet') }}</label>
                <input class="form-control {{ $errors->has('objet') ? 'is-invalid' : '' }}" type="number" name="objet" id="objet" value="{{ old('objet', $approve->objet) }}" step="1" required>
                @if($errors->has('objet'))
                    <span class="text-danger">{{ $errors->first('objet') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.approve.fields.objet_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.approve.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $approve->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.approve.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objecttype_id">{{ trans('cruds.approve.fields.objecttype') }}</label>
                <select class="form-control select2 {{ $errors->has('objecttype') ? 'is-invalid' : '' }}" name="objecttype_id" id="objecttype_id" required>
                    @foreach($objecttypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('objecttype_id') ? old('objecttype_id') : $approve->objecttype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('objecttype'))
                    <span class="text-danger">{{ $errors->first('objecttype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.approve.fields.objecttype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reason_id">{{ trans('cruds.approve.fields.reason') }}</label>
                <select class="form-control select2 {{ $errors->has('reason') ? 'is-invalid' : '' }}" name="reason_id" id="reason_id" required>
                    @foreach($reasons as $id => $entry)
                        <option value="{{ $id }}" {{ (old('reason_id') ? old('reason_id') : $approve->reason->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('reason'))
                    <span class="text-danger">{{ $errors->first('reason') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.approve.fields.reason_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="resultat">{{ trans('cruds.approve.fields.resultat') }}</label>
                <input class="form-control {{ $errors->has('resultat') ? 'is-invalid' : '' }}" type="text" name="resultat" id="resultat" value="{{ old('resultat', $approve->resultat) }}" required>
                @if($errors->has('resultat'))
                    <span class="text-danger">{{ $errors->first('resultat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.approve.fields.resultat_helper') }}</span>
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