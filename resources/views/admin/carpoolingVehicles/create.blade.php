@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.carpoolingVehicle.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.carpooling-vehicles.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="finition">{{ trans('cruds.carpoolingVehicle.fields.finition') }}</label>
                <input class="form-control {{ $errors->has('finition') ? 'is-invalid' : '' }}" type="text" name="finition" id="finition" value="{{ old('finition', '') }}" required>
                @if($errors->has('finition'))
                    <span class="text-danger">{{ $errors->first('finition') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.finition_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nb_place">{{ trans('cruds.carpoolingVehicle.fields.nb_place') }}</label>
                <input class="form-control {{ $errors->has('nb_place') ? 'is-invalid' : '' }}" type="number" name="nb_place" id="nb_place" value="{{ old('nb_place', '') }}" step="1" required>
                @if($errors->has('nb_place'))
                    <span class="text-danger">{{ $errors->first('nb_place') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.nb_place_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="annee_fabrication">{{ trans('cruds.carpoolingVehicle.fields.annee_fabrication') }}</label>
                <input class="form-control {{ $errors->has('annee_fabrication') ? 'is-invalid' : '' }}" type="text" name="annee_fabrication" id="annee_fabrication" value="{{ old('annee_fabrication', '') }}" required>
                @if($errors->has('annee_fabrication'))
                    <span class="text-danger">{{ $errors->first('annee_fabrication') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.annee_fabrication_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="conso_au_100_km">{{ trans('cruds.carpoolingVehicle.fields.conso_au_100_km') }}</label>
                <input class="form-control {{ $errors->has('conso_au_100_km') ? 'is-invalid' : '' }}" type="text" name="conso_au_100_km" id="conso_au_100_km" value="{{ old('conso_au_100_km', '') }}" required>
                @if($errors->has('conso_au_100_km'))
                    <span class="text-danger">{{ $errors->first('conso_au_100_km') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.conso_au_100_km_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nb_chevaux">{{ trans('cruds.carpoolingVehicle.fields.nb_chevaux') }}</label>
                <input class="form-control {{ $errors->has('nb_chevaux') ? 'is-invalid' : '' }}" type="number" name="nb_chevaux" id="nb_chevaux" value="{{ old('nb_chevaux', '') }}" step="1" required>
                @if($errors->has('nb_chevaux'))
                    <span class="text-danger">{{ $errors->first('nb_chevaux') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.nb_chevaux_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nb_cylindre">{{ trans('cruds.carpoolingVehicle.fields.nb_cylindre') }}</label>
                <input class="form-control {{ $errors->has('nb_cylindre') ? 'is-invalid' : '' }}" type="number" name="nb_cylindre" id="nb_cylindre" value="{{ old('nb_cylindre', '') }}" step="1">
                @if($errors->has('nb_cylindre'))
                    <span class="text-danger">{{ $errors->first('nb_cylindre') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.nb_cylindre_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="accessoires">{{ trans('cruds.carpoolingVehicle.fields.accessoires') }}</label>
                <input class="form-control {{ $errors->has('accessoires') ? 'is-invalid' : '' }}" type="text" name="accessoires" id="accessoires" value="{{ old('accessoires', '') }}">
                @if($errors->has('accessoires'))
                    <span class="text-danger">{{ $errors->first('accessoires') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.accessoires_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kilometrage">{{ trans('cruds.carpoolingVehicle.fields.kilometrage') }}</label>
                <input class="form-control {{ $errors->has('kilometrage') ? 'is-invalid' : '' }}" type="number" name="kilometrage" id="kilometrage" value="{{ old('kilometrage', '') }}" step="1" required>
                @if($errors->has('kilometrage'))
                    <span class="text-danger">{{ $errors->first('kilometrage') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.kilometrage_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="options">{{ trans('cruds.carpoolingVehicle.fields.options') }}</label>
                <input class="form-control {{ $errors->has('options') ? 'is-invalid' : '' }}" type="text" name="options" id="options" value="{{ old('options', '') }}" required>
                @if($errors->has('options'))
                    <span class="text-danger">{{ $errors->first('options') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.options_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pannes_signalees">{{ trans('cruds.carpoolingVehicle.fields.pannes_signalees') }}</label>
                <input class="form-control {{ $errors->has('pannes_signalees') ? 'is-invalid' : '' }}" type="text" name="pannes_signalees" id="pannes_signalees" value="{{ old('pannes_signalees', '') }}" required>
                @if($errors->has('pannes_signalees'))
                    <span class="text-danger">{{ $errors->first('pannes_signalees') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.pannes_signalees_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="immatriculation">{{ trans('cruds.carpoolingVehicle.fields.immatriculation') }}</label>
                <input class="form-control {{ $errors->has('immatriculation') ? 'is-invalid' : '' }}" type="text" name="immatriculation" id="immatriculation" value="{{ old('immatriculation', '') }}" required>
                @if($errors->has('immatriculation'))
                    <span class="text-danger">{{ $errors->first('immatriculation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.immatriculation_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="brand_id">{{ trans('cruds.carpoolingVehicle.fields.brand') }}</label>
                <select class="form-control select2 {{ $errors->has('brand') ? 'is-invalid' : '' }}" name="brand_id" id="brand_id" required>
                    @foreach($brands as $id => $entry)
                        <option value="{{ $id }}" {{ old('brand_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('brand'))
                    <span class="text-danger">{{ $errors->first('brand') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.brand_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="modelofvehicle_id">{{ trans('cruds.carpoolingVehicle.fields.modelofvehicle') }}</label>
                <select class="form-control select2 {{ $errors->has('modelofvehicle') ? 'is-invalid' : '' }}" name="modelofvehicle_id" id="modelofvehicle_id" required>
                    @foreach($modelofvehicles as $id => $entry)
                        <option value="{{ $id }}" {{ old('modelofvehicle_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('modelofvehicle'))
                    <span class="text-danger">{{ $errors->first('modelofvehicle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.modelofvehicle_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="colortype_id">{{ trans('cruds.carpoolingVehicle.fields.colortype') }}</label>
                <select class="form-control select2 {{ $errors->has('colortype') ? 'is-invalid' : '' }}" name="colortype_id" id="colortype_id" required>
                    @foreach($colortypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('colortype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('colortype'))
                    <span class="text-danger">{{ $errors->first('colortype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.colortype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="energytype_id">{{ trans('cruds.carpoolingVehicle.fields.energytype') }}</label>
                <select class="form-control select2 {{ $errors->has('energytype') ? 'is-invalid' : '' }}" name="energytype_id" id="energytype_id" required>
                    @foreach($energytypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('energytype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('energytype'))
                    <span class="text-danger">{{ $errors->first('energytype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.energytype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gearbox_id">{{ trans('cruds.carpoolingVehicle.fields.gearbox') }}</label>
                <select class="form-control select2 {{ $errors->has('gearbox') ? 'is-invalid' : '' }}" name="gearbox_id" id="gearbox_id" required>
                    @foreach($gearboxes as $id => $entry)
                        <option value="{{ $id }}" {{ old('gearbox_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('gearbox'))
                    <span class="text-danger">{{ $errors->first('gearbox') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.gearbox_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="vehicletype_id">{{ trans('cruds.carpoolingVehicle.fields.vehicletype') }}</label>
                <select class="form-control select2 {{ $errors->has('vehicletype') ? 'is-invalid' : '' }}" name="vehicletype_id" id="vehicletype_id" required>
                    @foreach($vehicletypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('vehicletype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vehicletype'))
                    <span class="text-danger">{{ $errors->first('vehicletype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.vehicletype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="motricitytype_id">{{ trans('cruds.carpoolingVehicle.fields.motricitytype') }}</label>
                <select class="form-control select2 {{ $errors->has('motricitytype') ? 'is-invalid' : '' }}" name="motricitytype_id" id="motricitytype_id" required>
                    @foreach($motricitytypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('motricitytype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('motricitytype'))
                    <span class="text-danger">{{ $errors->first('motricitytype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.motricitytype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeofwheel_id">{{ trans('cruds.carpoolingVehicle.fields.typeofwheel') }}</label>
                <select class="form-control select2 {{ $errors->has('typeofwheel') ? 'is-invalid' : '' }}" name="typeofwheel_id" id="typeofwheel_id" required>
                    @foreach($typeofwheels as $id => $entry)
                        <option value="{{ $id }}" {{ old('typeofwheel_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeofwheel'))
                    <span class="text-danger">{{ $errors->first('typeofwheel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.typeofwheel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="rimtype_id">{{ trans('cruds.carpoolingVehicle.fields.rimtype') }}</label>
                <select class="form-control select2 {{ $errors->has('rimtype') ? 'is-invalid' : '' }}" name="rimtype_id" id="rimtype_id" required>
                    @foreach($rimtypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('rimtype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('rimtype'))
                    <span class="text-danger">{{ $errors->first('rimtype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.rimtype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="listofcountry_id">{{ trans('cruds.carpoolingVehicle.fields.listofcountry') }}</label>
                <select class="form-control select2 {{ $errors->has('listofcountry') ? 'is-invalid' : '' }}" name="listofcountry_id" id="listofcountry_id" required>
                    @foreach($listofcountries as $id => $entry)
                        <option value="{{ $id }}" {{ old('listofcountry_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('listofcountry'))
                    <span class="text-danger">{{ $errors->first('listofcountry') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.listofcountry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.carpoolingVehicle.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="liststatut_id">{{ trans('cruds.carpoolingVehicle.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id" required>
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ old('liststatut_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeofutility_id">{{ trans('cruds.carpoolingVehicle.fields.typeofutility') }}</label>
                <select class="form-control select2 {{ $errors->has('typeofutility') ? 'is-invalid' : '' }}" name="typeofutility_id" id="typeofutility_id" required>
                    @foreach($typeofutilities as $id => $entry)
                        <option value="{{ $id }}" {{ old('typeofutility_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeofutility'))
                    <span class="text-danger">{{ $errors->first('typeofutility') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.typeofutility_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="libelle">{{ trans('cruds.carpoolingVehicle.fields.libelle') }}</label>
                <input class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" type="text" name="libelle" id="libelle" value="{{ old('libelle', '') }}" required>
                @if($errors->has('libelle'))
                    <span class="text-danger">{{ $errors->first('libelle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingVehicle.fields.libelle_helper') }}</span>
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