@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.besoinLocal.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.besoin-locals.update", [$besoinLocal->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nb_chambre">{{ trans('cruds.besoinLocal.fields.nb_chambre') }}</label>
                <input class="form-control {{ $errors->has('nb_chambre') ? 'is-invalid' : '' }}" type="number" name="nb_chambre" id="nb_chambre" value="{{ old('nb_chambre', $besoinLocal->nb_chambre) }}" step="1" required>
                @if($errors->has('nb_chambre'))
                    <span class="text-danger">{{ $errors->first('nb_chambre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.nb_chambre_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="localisation">{{ trans('cruds.besoinLocal.fields.localisation') }}</label>
                <textarea class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" name="localisation" id="localisation" required>{{ old('localisation', $besoinLocal->localisation) }}</textarea>
                @if($errors->has('localisation'))
                    <span class="text-danger">{{ $errors->first('localisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.localisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="geolocalisation">{{ trans('cruds.besoinLocal.fields.geolocalisation') }}</label>
                <input class="form-control {{ $errors->has('geolocalisation') ? 'is-invalid' : '' }}" type="text" name="geolocalisation" id="geolocalisation" value="{{ old('geolocalisation', $besoinLocal->geolocalisation) }}">
                @if($errors->has('geolocalisation'))
                    <span class="text-danger">{{ $errors->first('geolocalisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.geolocalisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.besoinLocal.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $besoinLocal->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="propertytype_id">{{ trans('cruds.besoinLocal.fields.propertytype') }}</label>
                <select class="form-control select2 {{ $errors->has('propertytype') ? 'is-invalid' : '' }}" name="propertytype_id" id="propertytype_id" required>
                    @foreach($propertytypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('propertytype_id') ? old('propertytype_id') : $besoinLocal->propertytype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('propertytype'))
                    <span class="text-danger">{{ $errors->first('propertytype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.propertytype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeoffer_id">{{ trans('cruds.besoinLocal.fields.typeoffer') }}</label>
                <select class="form-control select2 {{ $errors->has('typeoffer') ? 'is-invalid' : '' }}" name="typeoffer_id" id="typeoffer_id" required>
                    @foreach($typeoffers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('typeoffer_id') ? old('typeoffer_id') : $besoinLocal->typeoffer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeoffer'))
                    <span class="text-danger">{{ $errors->first('typeoffer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.typeoffer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="setcountry_id">{{ trans('cruds.besoinLocal.fields.setcountry') }}</label>
                <select class="form-control select2 {{ $errors->has('setcountry') ? 'is-invalid' : '' }}" name="setcountry_id" id="setcountry_id" required>
                    @foreach($setcountries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('setcountry_id') ? old('setcountry_id') : $besoinLocal->setcountry->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('setcountry'))
                    <span class="text-danger">{{ $errors->first('setcountry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.setcountry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.besoinLocal.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $besoinLocal->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quartier_id">{{ trans('cruds.besoinLocal.fields.quartier') }}</label>
                <select class="form-control select2 {{ $errors->has('quartier') ? 'is-invalid' : '' }}" name="quartier_id" id="quartier_id" required>
                    @foreach($quartiers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('quartier_id') ? old('quartier_id') : $besoinLocal->quartier->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('quartier'))
                    <span class="text-danger">{{ $errors->first('quartier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.quartier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="condition_location">{{ trans('cruds.besoinLocal.fields.condition_location') }}</label>
                <textarea class="form-control {{ $errors->has('condition_location') ? 'is-invalid' : '' }}" name="condition_location" id="condition_location">{{ old('condition_location', $besoinLocal->condition_location) }}</textarea>
                @if($errors->has('condition_location'))
                    <span class="text-danger">{{ $errors->first('condition_location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.condition_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="condition_vente">{{ trans('cruds.besoinLocal.fields.condition_vente') }}</label>
                <textarea class="form-control {{ $errors->has('condition_vente') ? 'is-invalid' : '' }}" name="condition_vente" id="condition_vente">{{ old('condition_vente', $besoinLocal->condition_vente) }}</textarea>
                @if($errors->has('condition_vente'))
                    <span class="text-danger">{{ $errors->first('condition_vente') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.condition_vente_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="liststatut_id">{{ trans('cruds.besoinLocal.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id">
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('liststatut_id') ? old('liststatut_id') : $besoinLocal->liststatut->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.besoinLocal.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $besoinLocal->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="libelle">{{ trans('cruds.besoinLocal.fields.libelle') }}</label>
                <input class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" type="text" name="libelle" id="libelle" value="{{ old('libelle', $besoinLocal->libelle) }}" required>
                @if($errors->has('libelle'))
                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.libelle_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_limite_demande">{{ trans('cruds.besoinLocal.fields.date_limite_demande') }}</label>
                <input class="form-control date {{ $errors->has('date_limite_demande') ? 'is-invalid' : '' }}" type="text" name="date_limite_demande" id="date_limite_demande" value="{{ old('date_limite_demande', $besoinLocal->date_limite_demande) }}">
                @if($errors->has('date_limite_demande'))
                    <span class="text-danger">{{ $errors->first('date_limite_demande') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.date_limite_demande_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="budget_max_achat">{{ trans('cruds.besoinLocal.fields.budget_max_achat') }}</label>
                <input class="form-control {{ $errors->has('budget_max_achat') ? 'is-invalid' : '' }}" type="number" name="budget_max_achat" id="budget_max_achat" value="{{ old('budget_max_achat', $besoinLocal->budget_max_achat) }}" step="1">
                @if($errors->has('budget_max_achat'))
                    <span class="text-danger">{{ $errors->first('budget_max_achat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.budget_max_achat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="budget_max_location">{{ trans('cruds.besoinLocal.fields.budget_max_location') }}</label>
                <input class="form-control {{ $errors->has('budget_max_location') ? 'is-invalid' : '' }}" type="number" name="budget_max_location" id="budget_max_location" value="{{ old('budget_max_location', $besoinLocal->budget_max_location) }}" step="1">
                @if($errors->has('budget_max_location'))
                    <span class="text-danger">{{ $errors->first('budget_max_location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.budget_max_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="emergencylevel_id">{{ trans('cruds.besoinLocal.fields.emergencylevel') }}</label>
                <select class="form-control select2 {{ $errors->has('emergencylevel') ? 'is-invalid' : '' }}" name="emergencylevel_id" id="emergencylevel_id" required>
                    @foreach($emergencylevels as $id => $entry)
                        <option value="{{ $id }}" {{ (old('emergencylevel_id') ? old('emergencylevel_id') : $besoinLocal->emergencylevel->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('emergencylevel'))
                    <span class="text-danger">{{ $errors->first('emergencylevel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.emergencylevel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="satisfait">{{ trans('cruds.besoinLocal.fields.satisfait') }}</label>
                <input class="form-control {{ $errors->has('satisfait') ? 'is-invalid' : '' }}" type="text" name="satisfait" id="satisfait" value="{{ old('satisfait', $besoinLocal->satisfait) }}">
                @if($errors->has('satisfait'))
                    <span class="text-danger">{{ $errors->first('satisfait') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.satisfait_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_satisfait">{{ trans('cruds.besoinLocal.fields.date_satisfait') }}</label>
                <input class="form-control date {{ $errors->has('date_satisfait') ? 'is-invalid' : '' }}" type="text" name="date_satisfait" id="date_satisfait" value="{{ old('date_satisfait', $besoinLocal->date_satisfait) }}">
                @if($errors->has('date_satisfait'))
                    <span class="text-danger">{{ $errors->first('date_satisfait') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.besoinLocal.fields.date_satisfait_helper') }}</span>
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