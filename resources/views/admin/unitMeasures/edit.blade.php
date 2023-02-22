@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.unitMeasure.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.unit-measures.update", [$unitMeasure->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="intitule">{{ trans('cruds.unitMeasure.fields.intitule') }}</label>
                <input class="form-control {{ $errors->has('intitule') ? 'is-invalid' : '' }}" type="text" name="intitule" id="intitule" value="{{ old('intitule', $unitMeasure->intitule) }}" required>
                @if($errors->has('intitule'))
                    <span class="text-danger">{{ $errors->first('intitule') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.unitMeasure.fields.intitule_helper') }}</span>
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