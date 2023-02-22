@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lodging.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lodgings.update", [$lodging->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nb_chambre">{{ trans('cruds.lodging.fields.nb_chambre') }}</label>
                <input class="form-control {{ $errors->has('nb_chambre') ? 'is-invalid' : '' }}" type="number" name="nb_chambre" id="nb_chambre" value="{{ old('nb_chambre', $lodging->nb_chambre) }}" step="1" required>
                @if($errors->has('nb_chambre'))
                    <span class="text-danger">{{ $errors->first('nb_chambre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.nb_chambre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_journalier">{{ trans('cruds.lodging.fields.prix_journalier') }}</label>
                <input class="form-control {{ $errors->has('prix_journalier') ? 'is-invalid' : '' }}" type="number" name="prix_journalier" id="prix_journalier" value="{{ old('prix_journalier', $lodging->prix_journalier) }}" step="1">
                @if($errors->has('prix_journalier'))
                    <span class="text-danger">{{ $errors->first('prix_journalier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.prix_journalier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_mensuel">{{ trans('cruds.lodging.fields.prix_mensuel') }}</label>
                <input class="form-control {{ $errors->has('prix_mensuel') ? 'is-invalid' : '' }}" type="number" name="prix_mensuel" id="prix_mensuel" value="{{ old('prix_mensuel', $lodging->prix_mensuel) }}" step="1">
                @if($errors->has('prix_mensuel'))
                    <span class="text-danger">{{ $errors->first('prix_mensuel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.prix_mensuel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="localisation">{{ trans('cruds.lodging.fields.localisation') }}</label>
                <textarea class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" name="localisation" id="localisation" required>{{ old('localisation', $lodging->localisation) }}</textarea>
                @if($errors->has('localisation'))
                    <span class="text-danger">{{ $errors->first('localisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.localisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="geolocalisation">{{ trans('cruds.lodging.fields.geolocalisation') }}</label>
                <input class="form-control {{ $errors->has('geolocalisation') ? 'is-invalid' : '' }}" type="text" name="geolocalisation" id="geolocalisation" value="{{ old('geolocalisation', $lodging->geolocalisation) }}">
                @if($errors->has('geolocalisation'))
                    <span class="text-danger">{{ $errors->first('geolocalisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.geolocalisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hostingtype_id">{{ trans('cruds.lodging.fields.hostingtype') }}</label>
                <select class="form-control select2 {{ $errors->has('hostingtype') ? 'is-invalid' : '' }}" name="hostingtype_id" id="hostingtype_id" required>
                    @foreach($hostingtypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('hostingtype_id') ? old('hostingtype_id') : $lodging->hostingtype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hostingtype'))
                    <span class="text-danger">{{ $errors->first('hostingtype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.hostingtype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeofhouse_id">{{ trans('cruds.lodging.fields.typeofhouse') }}</label>
                <select class="form-control select2 {{ $errors->has('typeofhouse') ? 'is-invalid' : '' }}" name="typeofhouse_id" id="typeofhouse_id" required>
                    @foreach($typeofhouses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('typeofhouse_id') ? old('typeofhouse_id') : $lodging->typeofhouse->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeofhouse'))
                    <span class="text-danger">{{ $errors->first('typeofhouse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.typeofhouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="setcountry_id">{{ trans('cruds.lodging.fields.setcountry') }}</label>
                <select class="form-control select2 {{ $errors->has('setcountry') ? 'is-invalid' : '' }}" name="setcountry_id" id="setcountry_id" required>
                    @foreach($setcountries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('setcountry_id') ? old('setcountry_id') : $lodging->setcountry->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('setcountry'))
                    <span class="text-danger">{{ $errors->first('setcountry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.setcountry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.lodging.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $lodging->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quartier_id">{{ trans('cruds.lodging.fields.quartier') }}</label>
                <select class="form-control select2 {{ $errors->has('quartier') ? 'is-invalid' : '' }}" name="quartier_id" id="quartier_id" required>
                    @foreach($quartiers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('quartier_id') ? old('quartier_id') : $lodging->quartier->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('quartier'))
                    <span class="text-danger">{{ $errors->first('quartier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.quartier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.lodging.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $lodging->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="liststatut_id">{{ trans('cruds.lodging.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id" required>
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('liststatut_id') ? old('liststatut_id') : $lodging->liststatut->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="libelle">{{ trans('cruds.lodging.fields.libelle') }}</label>
                <input class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" type="text" name="libelle" id="libelle" value="{{ old('libelle', $lodging->libelle) }}" required>
                @if($errors->has('libelle'))
                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.libelle_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.lodging.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', $lodging->description) }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lodging.fields.description_helper') }}</span>
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