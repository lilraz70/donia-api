@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.listStatut.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.list-statuts.update", [$listStatut->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="intitule">{{ trans('cruds.listStatut.fields.intitule') }}</label>
                <input class="form-control {{ $errors->has('intitule') ? 'is-invalid' : '' }}" type="text" name="intitule" id="intitule" value="{{ old('intitule', $listStatut->intitule) }}" required>
                @if($errors->has('intitule'))
                    <span class="text-danger">{{ $errors->first('intitule') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.listStatut.fields.intitule_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objecttype_id">{{ trans('cruds.listStatut.fields.objecttype') }}</label>
                <select class="form-control select2 {{ $errors->has('objecttype') ? 'is-invalid' : '' }}" name="objecttype_id" id="objecttype_id" required>
                    @foreach($objecttypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('objecttype_id') ? old('objecttype_id') : $listStatut->objecttype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('objecttype'))
                    <span class="text-danger">{{ $errors->first('objecttype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.listStatut.fields.objecttype_helper') }}</span>
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