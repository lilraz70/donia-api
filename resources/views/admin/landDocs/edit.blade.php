@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.landDoc.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.land-docs.update", [$landDoc->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="land_id">{{ trans('cruds.landDoc.fields.land') }}</label>
                <select class="form-control select2 {{ $errors->has('land') ? 'is-invalid' : '' }}" name="land_id" id="land_id" required>
                    @foreach($lands as $id => $entry)
                        <option value="{{ $id }}" {{ (old('land_id') ? old('land_id') : $landDoc->land->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('land'))
                    <span class="text-danger">{{ $errors->first('land') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.landDoc.fields.land_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeadmdoc_id">{{ trans('cruds.landDoc.fields.typeadmdoc') }}</label>
                <select class="form-control select2 {{ $errors->has('typeadmdoc') ? 'is-invalid' : '' }}" name="typeadmdoc_id" id="typeadmdoc_id" required>
                    @foreach($typeadmdocs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('typeadmdoc_id') ? old('typeadmdoc_id') : $landDoc->typeadmdoc->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeadmdoc'))
                    <span class="text-danger">{{ $errors->first('typeadmdoc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.landDoc.fields.typeadmdoc_helper') }}</span>
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