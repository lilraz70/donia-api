@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.carpool.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.carpools.update", [$carpool->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_client_id">{{ trans('cruds.carpool.fields.user_client') }}</label>
                <select class="form-control select2 {{ $errors->has('user_client') ? 'is-invalid' : '' }}" name="user_client_id" id="user_client_id" required>
                    @foreach($user_clients as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_client_id') ? old('user_client_id') : $carpool->user_client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_client'))
                    <span class="text-danger">{{ $errors->first('user_client') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.user_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_fournisseur_id">{{ trans('cruds.carpool.fields.user_fournisseur') }}</label>
                <select class="form-control select2 {{ $errors->has('user_fournisseur') ? 'is-invalid' : '' }}" name="user_fournisseur_id" id="user_fournisseur_id" required>
                    @foreach($user_fournisseurs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_fournisseur_id') ? old('user_fournisseur_id') : $carpool->user_fournisseur->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_fournisseur'))
                    <span class="text-danger">{{ $errors->first('user_fournisseur') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.user_fournisseur_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="paiement">{{ trans('cruds.carpool.fields.paiement') }}</label>
                <input class="form-control {{ $errors->has('paiement') ? 'is-invalid' : '' }}" type="text" name="paiement" id="paiement" value="{{ old('paiement', $carpool->paiement) }}" required>
                @if($errors->has('paiement'))
                    <span class="text-danger">{{ $errors->first('paiement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.paiement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="preuve_paiement">{{ trans('cruds.carpool.fields.preuve_paiement') }}</label>
                <input class="form-control {{ $errors->has('preuve_paiement') ? 'is-invalid' : '' }}" type="text" name="preuve_paiement" id="preuve_paiement" value="{{ old('preuve_paiement', $carpool->preuve_paiement) }}">
                @if($errors->has('preuve_paiement'))
                    <span class="text-danger">{{ $errors->first('preuve_paiement') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.preuve_paiement_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="paymentmode_id">{{ trans('cruds.carpool.fields.paymentmode') }}</label>
                <select class="form-control select2 {{ $errors->has('paymentmode') ? 'is-invalid' : '' }}" name="paymentmode_id" id="paymentmode_id">
                    @foreach($paymentmodes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('paymentmode_id') ? old('paymentmode_id') : $carpool->paymentmode->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('paymentmode'))
                    <span class="text-danger">{{ $errors->first('paymentmode') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.paymentmode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mention_arrive">{{ trans('cruds.carpool.fields.mention_arrive') }}</label>
                <input class="form-control {{ $errors->has('mention_arrive') ? 'is-invalid' : '' }}" type="text" name="mention_arrive" id="mention_arrive" value="{{ old('mention_arrive', $carpool->mention_arrive) }}">
                @if($errors->has('mention_arrive'))
                    <span class="text-danger">{{ $errors->first('mention_arrive') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.mention_arrive_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mention_arv_heure">{{ trans('cruds.carpool.fields.mention_arv_heure') }}</label>
                <input class="form-control {{ $errors->has('mention_arv_heure') ? 'is-invalid' : '' }}" type="text" name="mention_arv_heure" id="mention_arv_heure" value="{{ old('mention_arv_heure', $carpool->mention_arv_heure) }}">
                @if($errors->has('mention_arv_heure'))
                    <span class="text-danger">{{ $errors->first('mention_arv_heure') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.mention_arv_heure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="trip_id">{{ trans('cruds.carpool.fields.trip') }}</label>
                <select class="form-control select2 {{ $errors->has('trip') ? 'is-invalid' : '' }}" name="trip_id" id="trip_id" required>
                    @foreach($trips as $id => $entry)
                        <option value="{{ $id }}" {{ (old('trip_id') ? old('trip_id') : $carpool->trip->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('trip'))
                    <span class="text-danger">{{ $errors->first('trip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.trip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="liststatut_id">{{ trans('cruds.carpool.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id">
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('liststatut_id') ? old('liststatut_id') : $carpool->liststatut->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="carpoolingvehicle_id">{{ trans('cruds.carpool.fields.carpoolingvehicle') }}</label>
                <select class="form-control select2 {{ $errors->has('carpoolingvehicle') ? 'is-invalid' : '' }}" name="carpoolingvehicle_id" id="carpoolingvehicle_id" required>
                    @foreach($carpoolingvehicles as $id => $entry)
                        <option value="{{ $id }}" {{ (old('carpoolingvehicle_id') ? old('carpoolingvehicle_id') : $carpool->carpoolingvehicle->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('carpoolingvehicle'))
                    <span class="text-danger">{{ $errors->first('carpoolingvehicle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.carpool.fields.carpoolingvehicle_helper') }}</span>
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