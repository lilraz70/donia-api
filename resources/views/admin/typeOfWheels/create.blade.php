@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.typeOfWheel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.type-of-wheels.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="intitule">{{ trans('cruds.typeOfWheel.fields.intitule') }}</label>
                <input class="form-control {{ $errors->has('intitule') ? 'is-invalid' : '' }}" type="text" name="intitule" id="intitule" value="{{ old('intitule', '') }}" required>
                @if($errors->has('intitule'))
                    <span class="text-danger">{{ $errors->first('intitule') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.typeOfWheel.fields.intitule_helper') }}</span>
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