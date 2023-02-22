@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.setCountry.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.set-countries.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="intitule">{{ trans('cruds.setCountry.fields.intitule') }}</label>
                <input class="form-control {{ $errors->has('intitule') ? 'is-invalid' : '' }}" type="text" name="intitule" id="intitule" value="{{ old('intitule', '') }}" required>
                @if($errors->has('intitule'))
                    <span class="text-danger">{{ $errors->first('intitule') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setCountry.fields.intitule_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="code">{{ trans('cruds.setCountry.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setCountry.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="prefix">{{ trans('cruds.setCountry.fields.prefix') }}</label>
                <input class="form-control {{ $errors->has('prefix') ? 'is-invalid' : '' }}" type="text" name="prefix" id="prefix" value="{{ old('prefix', '') }}" required>
                @if($errors->has('prefix'))
                    <span class="text-danger">{{ $errors->first('prefix') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setCountry.fields.prefix_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="flag">{{ trans('cruds.setCountry.fields.flag') }}</label>
                <input class="form-control {{ $errors->has('flag') ? 'is-invalid' : '' }}" type="text" name="flag" id="flag" value="{{ old('flag', '') }}" required>
                @if($errors->has('flag'))
                    <span class="text-danger">{{ $errors->first('flag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setCountry.fields.flag_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.setCountry.fields.statut') }}</label>
                <select class="form-control {{ $errors->has('statut') ? 'is-invalid' : '' }}" name="statut" id="statut">
                    <option value disabled {{ old('statut', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\SetCountry::STATUT_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('statut', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('statut'))
                    <span class="text-danger">{{ $errors->first('statut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.setCountry.fields.statut_helper') }}</span>
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