@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.releaseGood.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.release-goods.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="date_sorti_prevu">{{ trans('cruds.releaseGood.fields.date_sorti_prevu') }}</label>
                <input class="form-control date {{ $errors->has('date_sorti_prevu') ? 'is-invalid' : '' }}" type="text" name="date_sorti_prevu" id="date_sorti_prevu" value="{{ old('date_sorti_prevu') }}" required>
                @if($errors->has('date_sorti_prevu'))
                    <span class="text-danger">{{ $errors->first('date_sorti_prevu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.date_sorti_prevu_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="conditions_bailleur">{{ trans('cruds.releaseGood.fields.conditions_bailleur') }}</label>
                <textarea class="form-control {{ $errors->has('conditions_bailleur') ? 'is-invalid' : '' }}" name="conditions_bailleur" id="conditions_bailleur" required>{{ old('conditions_bailleur') }}</textarea>
                @if($errors->has('conditions_bailleur'))
                    <span class="text-danger">{{ $errors->first('conditions_bailleur') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.conditions_bailleur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="commentaires">{{ trans('cruds.releaseGood.fields.commentaires') }}</label>
                <textarea class="form-control {{ $errors->has('commentaires') ? 'is-invalid' : '' }}" name="commentaires" id="commentaires">{{ old('commentaires') }}</textarea>
                @if($errors->has('commentaires'))
                    <span class="text-danger">{{ $errors->first('commentaires') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.commentaires_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nb_chambre">{{ trans('cruds.releaseGood.fields.nb_chambre') }}</label>
                <input class="form-control {{ $errors->has('nb_chambre') ? 'is-invalid' : '' }}" type="number" name="nb_chambre" id="nb_chambre" value="{{ old('nb_chambre', '') }}" step="1" required>
                @if($errors->has('nb_chambre'))
                    <span class="text-danger">{{ $errors->first('nb_chambre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.nb_chambre_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="localisation">{{ trans('cruds.releaseGood.fields.localisation') }}</label>
                <textarea class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" name="localisation" id="localisation" required>{{ old('localisation') }}</textarea>
                @if($errors->has('localisation'))
                    <span class="text-danger">{{ $errors->first('localisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.localisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="geolocalisation">{{ trans('cruds.releaseGood.fields.geolocalisation') }}</label>
                <input class="form-control {{ $errors->has('geolocalisation') ? 'is-invalid' : '' }}" type="text" name="geolocalisation" id="geolocalisation" value="{{ old('geolocalisation', '') }}">
                @if($errors->has('geolocalisation'))
                    <span class="text-danger">{{ $errors->first('geolocalisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.geolocalisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_limite">{{ trans('cruds.releaseGood.fields.date_limite') }}</label>
                <input class="form-control date {{ $errors->has('date_limite') ? 'is-invalid' : '' }}" type="text" name="date_limite" id="date_limite" value="{{ old('date_limite') }}">
                @if($errors->has('date_limite'))
                    <span class="text-danger">{{ $errors->first('date_limite') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.date_limite_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="contact_bailleur">{{ trans('cruds.releaseGood.fields.contact_bailleur') }}</label>
                <input class="form-control {{ $errors->has('contact_bailleur') ? 'is-invalid' : '' }}" type="text" name="contact_bailleur" id="contact_bailleur" value="{{ old('contact_bailleur', '') }}" required>
                @if($errors->has('contact_bailleur'))
                    <span class="text-danger">{{ $errors->first('contact_bailleur') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.contact_bailleur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="accord_bailleur">{{ trans('cruds.releaseGood.fields.accord_bailleur') }}</label>
                <input class="form-control {{ $errors->has('accord_bailleur') ? 'is-invalid' : '' }}" type="text" name="accord_bailleur" id="accord_bailleur" value="{{ old('accord_bailleur', '') }}">
                @if($errors->has('accord_bailleur'))
                    <span class="text-danger">{{ $errors->first('accord_bailleur') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.accord_bailleur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="propertytype_id">{{ trans('cruds.releaseGood.fields.propertytype') }}</label>
                <select class="form-control select2 {{ $errors->has('propertytype') ? 'is-invalid' : '' }}" name="propertytype_id" id="propertytype_id" required>
                    @foreach($propertytypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('propertytype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('propertytype'))
                    <span class="text-danger">{{ $errors->first('propertytype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.propertytype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="setcountry_id">{{ trans('cruds.releaseGood.fields.setcountry') }}</label>
                <select class="form-control select2 {{ $errors->has('setcountry') ? 'is-invalid' : '' }}" name="setcountry_id" id="setcountry_id" required>
                    @foreach($setcountries as $id => $entry)
                        <option value="{{ $id }}" {{ old('setcountry_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('setcountry'))
                    <span class="text-danger">{{ $errors->first('setcountry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.setcountry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.releaseGood.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quartier_id">{{ trans('cruds.releaseGood.fields.quartier') }}</label>
                <select class="form-control select2 {{ $errors->has('quartier') ? 'is-invalid' : '' }}" name="quartier_id" id="quartier_id" required>
                    @foreach($quartiers as $id => $entry)
                        <option value="{{ $id }}" {{ old('quartier_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('quartier'))
                    <span class="text-danger">{{ $errors->first('quartier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.quartier_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.releaseGood.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="liststatut_id">{{ trans('cruds.releaseGood.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id">
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ old('liststatut_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="emergencylevel_id">{{ trans('cruds.releaseGood.fields.emergencylevel') }}</label>
                <select class="form-control select2 {{ $errors->has('emergencylevel') ? 'is-invalid' : '' }}" name="emergencylevel_id" id="emergencylevel_id" required>
                    @foreach($emergencylevels as $id => $entry)
                        <option value="{{ $id }}" {{ old('emergencylevel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('emergencylevel'))
                    <span class="text-danger">{{ $errors->first('emergencylevel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.emergencylevel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="libelle">{{ trans('cruds.releaseGood.fields.libelle') }}</label>
                <input class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" type="text" name="libelle" id="libelle" value="{{ old('libelle', '') }}">
                @if($errors->has('libelle'))
                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.libelle_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.releaseGood.fields.verif_accord_bailleur') }}</label>
                @foreach(App\Models\ReleaseGood::VERIF_ACCORD_BAILLEUR_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('verif_accord_bailleur') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="verif_accord_bailleur_{{ $key }}" name="verif_accord_bailleur" value="{{ $key }}" {{ old('verif_accord_bailleur', '0') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="verif_accord_bailleur_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('verif_accord_bailleur'))
                    <span class="text-danger">{{ $errors->first('verif_accord_bailleur') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.verif_accord_bailleur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="cout">{{ trans('cruds.releaseGood.fields.cout') }}</label>
                <input class="form-control {{ $errors->has('cout') ? 'is-invalid' : '' }}" type="number" name="cout" id="cout" value="{{ old('cout', '') }}" step="1" required>
                @if($errors->has('cout'))
                    <span class="text-danger">{{ $errors->first('cout') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.cout_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.releaseGood.fields.loyer_augmentera') }}</label>
                @foreach(App\Models\ReleaseGood::LOYER_AUGMENTERA_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('loyer_augmentera') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="loyer_augmentera_{{ $key }}" name="loyer_augmentera" value="{{ $key }}" {{ old('loyer_augmentera', '0') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="loyer_augmentera_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('loyer_augmentera'))
                    <span class="text-danger">{{ $errors->first('loyer_augmentera') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGood.fields.loyer_augmentera_helper') }}</span>
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