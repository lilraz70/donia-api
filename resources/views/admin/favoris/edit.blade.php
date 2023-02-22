@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.favori.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.favoris.update", [$favori->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="object">{{ trans('cruds.favori.fields.object') }}</label>
                <input class="form-control {{ $errors->has('object') ? 'is-invalid' : '' }}" type="text" name="object" id="object" value="{{ old('object', $favori->object) }}" required>
                @if($errors->has('object'))
                    <span class="text-danger">{{ $errors->first('object') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.favori.fields.object_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objecttype_id">{{ trans('cruds.favori.fields.objecttype') }}</label>
                <select class="form-control select2 {{ $errors->has('objecttype') ? 'is-invalid' : '' }}" name="objecttype_id" id="objecttype_id" required>
                    @foreach($objecttypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('objecttype_id') ? old('objecttype_id') : $favori->objecttype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('objecttype'))
                    <span class="text-danger">{{ $errors->first('objecttype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.favori.fields.objecttype_helper') }}</span>
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