@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.configuration.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.configurations.update", [$configuration->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="cle">{{ trans('cruds.configuration.fields.cle') }}</label>
                <input class="form-control {{ $errors->has('cle') ? 'is-invalid' : '' }}" type="text" name="cle" id="cle" value="{{ old('cle', $configuration->cle) }}" required>
                @if($errors->has('cle'))
                    <span class="text-danger">{{ $errors->first('cle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.configuration.fields.cle_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="valeur">{{ trans('cruds.configuration.fields.valeur') }}</label>
                <input class="form-control {{ $errors->has('valeur') ? 'is-invalid' : '' }}" type="text" name="valeur" id="valeur" value="{{ old('valeur', $configuration->valeur) }}">
                @if($errors->has('valeur'))
                    <span class="text-danger">{{ $errors->first('valeur') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.configuration.fields.valeur_helper') }}</span>
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