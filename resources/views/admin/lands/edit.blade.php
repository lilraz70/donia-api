@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.land.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lands.update", [$land->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="superficie">{{ trans('cruds.land.fields.superficie') }}</label>
                <input class="form-control {{ $errors->has('superficie') ? 'is-invalid' : '' }}" type="number" name="superficie" id="superficie" value="{{ old('superficie', $land->superficie) }}" step="0.01" required>
                @if($errors->has('superficie'))
                    <span class="text-danger">{{ $errors->first('superficie') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.superficie_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="localisation">{{ trans('cruds.land.fields.localisation') }}</label>
                <textarea class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}" name="localisation" id="localisation" required>{{ old('localisation', $land->localisation) }}</textarea>
                @if($errors->has('localisation'))
                    <span class="text-danger">{{ $errors->first('localisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.localisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="geolocalisation">{{ trans('cruds.land.fields.geolocalisation') }}</label>
                <input class="form-control {{ $errors->has('geolocalisation') ? 'is-invalid' : '' }}" type="text" name="geolocalisation" id="geolocalisation" value="{{ old('geolocalisation', $land->geolocalisation) }}">
                @if($errors->has('geolocalisation'))
                    <span class="text-danger">{{ $errors->first('geolocalisation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.geolocalisation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.land.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $land->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="propertytype_id">{{ trans('cruds.land.fields.propertytype') }}</label>
                <select class="form-control select2 {{ $errors->has('propertytype') ? 'is-invalid' : '' }}" name="propertytype_id" id="propertytype_id" required>
                    @foreach($propertytypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('propertytype_id') ? old('propertytype_id') : $land->propertytype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('propertytype'))
                    <span class="text-danger">{{ $errors->first('propertytype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.propertytype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeoffer_id">{{ trans('cruds.land.fields.typeoffer') }}</label>
                <select class="form-control select2 {{ $errors->has('typeoffer') ? 'is-invalid' : '' }}" name="typeoffer_id" id="typeoffer_id" required>
                    @foreach($typeoffers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('typeoffer_id') ? old('typeoffer_id') : $land->typeoffer->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeoffer'))
                    <span class="text-danger">{{ $errors->first('typeoffer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.typeoffer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="setcountry_id">{{ trans('cruds.land.fields.setcountry') }}</label>
                <select class="form-control select2 {{ $errors->has('setcountry') ? 'is-invalid' : '' }}" name="setcountry_id" id="setcountry_id" required>
                    @foreach($setcountries as $id => $entry)
                        <option value="{{ $id }}" {{ (old('setcountry_id') ? old('setcountry_id') : $land->setcountry->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('setcountry'))
                    <span class="text-danger">{{ $errors->first('setcountry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.setcountry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.land.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $land->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quartier_id">{{ trans('cruds.land.fields.quartier') }}</label>
                <select class="form-control select2 {{ $errors->has('quartier') ? 'is-invalid' : '' }}" name="quartier_id" id="quartier_id" required>
                    @foreach($quartiers as $id => $entry)
                        <option value="{{ $id }}" {{ (old('quartier_id') ? old('quartier_id') : $land->quartier->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('quartier'))
                    <span class="text-danger">{{ $errors->first('quartier') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.quartier_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_vente">{{ trans('cruds.land.fields.prix_vente') }}</label>
                <input class="form-control {{ $errors->has('prix_vente') ? 'is-invalid' : '' }}" type="number" name="prix_vente" id="prix_vente" value="{{ old('prix_vente', $land->prix_vente) }}" step="1">
                @if($errors->has('prix_vente'))
                    <span class="text-danger">{{ $errors->first('prix_vente') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.prix_vente_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prix_location">{{ trans('cruds.land.fields.prix_location') }}</label>
                <input class="form-control {{ $errors->has('prix_location') ? 'is-invalid' : '' }}" type="number" name="prix_location" id="prix_location" value="{{ old('prix_location', $land->prix_location) }}" step="1">
                @if($errors->has('prix_location'))
                    <span class="text-danger">{{ $errors->first('prix_location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.prix_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="condition_location">{{ trans('cruds.land.fields.condition_location') }}</label>
                <textarea class="form-control {{ $errors->has('condition_location') ? 'is-invalid' : '' }}" name="condition_location" id="condition_location">{{ old('condition_location', $land->condition_location) }}</textarea>
                @if($errors->has('condition_location'))
                    <span class="text-danger">{{ $errors->first('condition_location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.condition_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="condition_vente">{{ trans('cruds.land.fields.condition_vente') }}</label>
                <textarea class="form-control {{ $errors->has('condition_vente') ? 'is-invalid' : '' }}" name="condition_vente" id="condition_vente">{{ old('condition_vente', $land->condition_vente) }}</textarea>
                @if($errors->has('condition_vente'))
                    <span class="text-danger">{{ $errors->first('condition_vente') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.condition_vente_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="liststatut_id">{{ trans('cruds.land.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id">
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('liststatut_id') ? old('liststatut_id') : $land->liststatut->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.land.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $land->description) }}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="landcategory_id">{{ trans('cruds.land.fields.landcategory') }}</label>
                <select class="form-control select2 {{ $errors->has('landcategory') ? 'is-invalid' : '' }}" name="landcategory_id" id="landcategory_id" required>
                    @foreach($landcategories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('landcategory_id') ? old('landcategory_id') : $land->landcategory->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('landcategory'))
                    <span class="text-danger">{{ $errors->first('landcategory') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.landcategory_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="libelle">{{ trans('cruds.land.fields.libelle') }}</label>
                <input class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" type="text" name="libelle" id="libelle" value="{{ old('libelle', $land->libelle) }}" required>
                @if($errors->has('libelle'))
                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.land.fields.libelle_helper') }}</span>
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