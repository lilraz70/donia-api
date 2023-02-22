@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.quartier.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.quartiers.update", [$quartier->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="intitule">{{ trans('cruds.quartier.fields.intitule') }}</label>
                <input class="form-control {{ $errors->has('intitule') ? 'is-invalid' : '' }}" type="text" name="intitule" id="intitule" value="{{ old('intitule', $quartier->intitule) }}" required>
                @if($errors->has('intitule'))
                    <span class="text-danger">{{ $errors->first('intitule') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quartier.fields.intitule_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="set_countries_id">{{ trans('cruds.quartier.fields.set_countries') }}</label>
                <select class="form-control select2 {{ $errors->has('set_countries') ? 'is-invalid' : '' }}" name="set_countries_id" id="set_countries_id" required>
                    @foreach($set_countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('set_countries_id') ? old('set_countries_id') : $quartier->set_countries->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('set_countries'))
                    <span class="text-danger">{{ $errors->first('set_countries') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quartier.fields.set_countries_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.quartier.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $quartier->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.quartier.fields.city_helper') }}</span>
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