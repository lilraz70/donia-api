@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.notification.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notifications.update", [$notification->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="contenu">{{ trans('cruds.notification.fields.contenu') }}</label>
                <input class="form-control {{ $errors->has('contenu') ? 'is-invalid' : '' }}" type="text" name="contenu" id="contenu" value="{{ old('contenu', $notification->contenu) }}" required>
                @if($errors->has('contenu'))
                    <span class="text-danger">{{ $errors->first('contenu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.contenu_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sujet">{{ trans('cruds.notification.fields.sujet') }}</label>
                <input class="form-control {{ $errors->has('sujet') ? 'is-invalid' : '' }}" type="text" name="sujet" id="sujet" value="{{ old('sujet', $notification->sujet) }}" required>
                @if($errors->has('sujet'))
                    <span class="text-danger">{{ $errors->first('sujet') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.sujet_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="areasofservice_id">{{ trans('cruds.notification.fields.areasofservice') }}</label>
                <select class="form-control select2 {{ $errors->has('areasofservice') ? 'is-invalid' : '' }}" name="areasofservice_id" id="areasofservice_id" required>
                    @foreach($areasofservices as $id => $entry)
                        <option value="{{ $id }}" {{ (old('areasofservice_id') ? old('areasofservice_id') : $notification->areasofservice->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('areasofservice'))
                    <span class="text-danger">{{ $errors->first('areasofservice') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.areasofservice_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objecttype_id">{{ trans('cruds.notification.fields.objecttype') }}</label>
                <select class="form-control select2 {{ $errors->has('objecttype') ? 'is-invalid' : '' }}" name="objecttype_id" id="objecttype_id" required>
                    @foreach($objecttypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('objecttype_id') ? old('objecttype_id') : $notification->objecttype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('objecttype'))
                    <span class="text-danger">{{ $errors->first('objecttype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.objecttype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.notification.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $notification->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="object">{{ trans('cruds.notification.fields.object') }}</label>
                <input class="form-control {{ $errors->has('object') ? 'is-invalid' : '' }}" type="number" name="object" id="object" value="{{ old('object', $notification->object) }}" step="1" required>
                @if($errors->has('object'))
                    <span class="text-danger">{{ $errors->first('object') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.notification.fields.object_helper') }}</span>
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