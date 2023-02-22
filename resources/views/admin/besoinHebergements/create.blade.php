@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.besoinHebergement.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.besoin-hebergements.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nb_chambre">{{ trans('cruds.besoinHebergement.fields.nb_chambre') }}</label>
                <input class="form-control {{ $errors->has('nb_chambre') ? 'is-invalid' : '' }}" type="number" name="nb_chambre" id="nb_chambre" value="{{ old('nb_chambre', '') }}" step="1" required>
                @if($errors->has('nb_chambre'))
                    <span class="text-danger">{{ $errors->first('nb_chambre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.nb_chambre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_journalier">{{ trans('cruds.besoinHebergement.fields.prix_journalier') }}</label>
                <input class="form-control {{ $errors->has('prix_journalier') ? 'is-invalid' : '' }}" type="number" name="prix_journalier" id="prix_journalier" value="{{ old('prix_journalier', '') }}" step="1">
                @if($errors->has('prix_journalier'))
                    <span class="text-danger">{{ $errors->first('prix_journalier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.prix_journalier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_mensuel">{{ trans('cruds.besoinHebergement.fields.prix_mensuel') }}</label>
                <input class="form-control {{ $errors->has('prix_mensuel') ? 'is-invalid' : '' }}" type="number" name="prix_mensuel" id="prix_mensuel" value="{{ old('prix_mensuel', '') }}" step="1">
                @if($errors->has('prix_mensuel'))
                    <span class="text-danger">{{ $errors->first('prix_mensuel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.prix_mensuel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="localisation">{{ trans('cruds.besoinHebergement.fields.localisation') }}</label>
                <textarea class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" name="localisation" id="localisation" required>{{ old('localisation') }}</textarea>
                @if($errors->has('localisation'))
                    <span class="text-danger">{{ $errors->first('localisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.localisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="geolocalisation">{{ trans('cruds.besoinHebergement.fields.geolocalisation') }}</label>
                <input class="form-control {{ $errors->has('geolocalisation') ? 'is-invalid' : '' }}" type="text" name="geolocalisation" id="geolocalisation" value="{{ old('geolocalisation', '') }}">
                @if($errors->has('geolocalisation'))
                    <span class="text-danger">{{ $errors->first('geolocalisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.geolocalisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hostingtype_id">{{ trans('cruds.besoinHebergement.fields.hostingtype') }}</label>
                <select class="form-control select2 {{ $errors->has('hostingtype') ? 'is-invalid' : '' }}" name="hostingtype_id" id="hostingtype_id" required>
                    @foreach($hostingtypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('hostingtype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('hostingtype'))
                    <span class="text-danger">{{ $errors->first('hostingtype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.hostingtype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeofhouse_id">{{ trans('cruds.besoinHebergement.fields.typeofhouse') }}</label>
                <select class="form-control select2 {{ $errors->has('typeofhouse') ? 'is-invalid' : '' }}" name="typeofhouse_id" id="typeofhouse_id" required>
                    @foreach($typeofhouses as $id => $entry)
                        <option value="{{ $id }}" {{ old('typeofhouse_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeofhouse'))
                    <span class="text-danger">{{ $errors->first('typeofhouse') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.typeofhouse_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="setcountry_id">{{ trans('cruds.besoinHebergement.fields.setcountry') }}</label>
                <select class="form-control select2 {{ $errors->has('setcountry') ? 'is-invalid' : '' }}" name="setcountry_id" id="setcountry_id" required>
                    @foreach($setcountries as $id => $entry)
                        <option value="{{ $id }}" {{ old('setcountry_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('setcountry'))
                    <span class="text-danger">{{ $errors->first('setcountry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.setcountry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.besoinHebergement.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quartier_id">{{ trans('cruds.besoinHebergement.fields.quartier') }}</label>
                <select class="form-control select2 {{ $errors->has('quartier') ? 'is-invalid' : '' }}" name="quartier_id" id="quartier_id" required>
                    @foreach($quartiers as $id => $entry)
                        <option value="{{ $id }}" {{ old('quartier_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('quartier'))
                    <span class="text-danger">{{ $errors->first('quartier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.quartier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.besoinHebergement.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="liststatut_id">{{ trans('cruds.besoinHebergement.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id" required>
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ old('liststatut_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="libelle">{{ trans('cruds.besoinHebergement.fields.libelle') }}</label>
                <input class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" type="text" name="libelle" id="libelle" value="{{ old('libelle', '') }}" required>
                @if($errors->has('libelle'))
                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.libelle_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.besoinHebergement.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="emergencylevel_id">{{ trans('cruds.besoinHebergement.fields.emergencylevel') }}</label>
                <select class="form-control select2 {{ $errors->has('emergencylevel') ? 'is-invalid' : '' }}" name="emergencylevel_id" id="emergencylevel_id" required>
                    @foreach($emergencylevels as $id => $entry)
                        <option value="{{ $id }}" {{ old('emergencylevel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('emergencylevel'))
                    <span class="text-danger">{{ $errors->first('emergencylevel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.emergencylevel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="satisfait">{{ trans('cruds.besoinHebergement.fields.satisfait') }}</label>
                <input class="form-control {{ $errors->has('satisfait') ? 'is-invalid' : '' }}" type="text" name="satisfait" id="satisfait" value="{{ old('satisfait', '') }}">
                @if($errors->has('satisfait'))
                    <span class="text-danger">{{ $errors->first('satisfait') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.satisfait_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_satisfait">{{ trans('cruds.besoinHebergement.fields.date_satisfait') }}</label>
                <input class="form-control date {{ $errors->has('date_satisfait') ? 'is-invalid' : '' }}" type="text" name="date_satisfait" id="date_satisfait" value="{{ old('date_satisfait') }}">
                @if($errors->has('date_satisfait'))
                    <span class="text-danger">{{ $errors->first('date_satisfait') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.date_satisfait_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="conveniences">{{ trans('cruds.besoinHebergement.fields.conveniences') }}</label>
                <input class="form-control {{ $errors->has('conveniences') ? 'is-invalid' : '' }}" type="text" name="conveniences" id="conveniences" value="{{ old('conveniences', '') }}">
                @if($errors->has('conveniences'))
                    <span class="text-danger">{{ $errors->first('conveniences') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.conveniences_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="servicesinclus">{{ trans('cruds.besoinHebergement.fields.servicesinclus') }}</label>
                <input class="form-control {{ $errors->has('servicesinclus') ? 'is-invalid' : '' }}" type="text" name="servicesinclus" id="servicesinclus" value="{{ old('servicesinclus', '') }}">
                @if($errors->has('servicesinclus'))
                    <span class="text-danger">{{ $errors->first('servicesinclus') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinHebergement.fields.servicesinclus_helper') }}</span>
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