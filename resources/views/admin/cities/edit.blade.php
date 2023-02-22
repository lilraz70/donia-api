@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.city.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cities.update", [$city->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="intitule">{{ trans('cruds.city.fields.intitule') }}</label>
                <input class="form-control {{ $errors->has('intitule') ? 'is-invalid' : '' }}" type="text" name="intitule" id="intitule" value="{{ old('intitule', $city->intitule) }}" required>
                @if($errors->has('intitule'))
                    <span class="text-danger">{{ $errors->first('intitule') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.city.fields.intitule_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="set_countries_id">{{ trans('cruds.city.fields.set_countries') }}</label>
                <select class="form-control select2 {{ $errors->has('set_countries') ? 'is-invalid' : '' }}" name="set_countries_id" id="set_countries_id" required>
                    @foreach($set_countries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('set_countries_id') ? old('set_countries_id') : $city->set_countries->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('set_countries'))
                    <span class="text-danger">{{ $errors->first('set_countries') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.city.fields.set_countries_helper') }}</span>
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