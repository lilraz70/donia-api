@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.trip.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trips.update", [$trip->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="intitule">{{ trans('cruds.trip.fields.intitule') }}</label>
                <input class="form-control {{ $errors->has('intitule') ? 'is-invalid' : '' }}" type="text" name="intitule" id="intitule" value="{{ old('intitule', $trip->intitule) }}" required>
                @if($errors->has('intitule'))
                    <span class="text-danger">{{ $errors->first('intitule') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.intitule_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lieu_depart">{{ trans('cruds.trip.fields.lieu_depart') }}</label>
                <input class="form-control {{ $errors->has('lieu_depart') ? 'is-invalid' : '' }}" type="text" name="lieu_depart" id="lieu_depart" value="{{ old('lieu_depart', $trip->lieu_depart) }}" required>
                @if($errors->has('lieu_depart'))
                    <span class="text-danger">{{ $errors->first('lieu_depart') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.lieu_depart_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="heure_depart">{{ trans('cruds.trip.fields.heure_depart') }}</label>
                <input class="form-control {{ $errors->has('heure_depart') ? 'is-invalid' : '' }}" type="text" name="heure_depart" id="heure_depart" value="{{ old('heure_depart', $trip->heure_depart) }}" required>
                @if($errors->has('heure_depart'))
                    <span class="text-danger">{{ $errors->first('heure_depart') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.heure_depart_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lieu_arrive">{{ trans('cruds.trip.fields.lieu_arrive') }}</label>
                <input class="form-control {{ $errors->has('lieu_arrive') ? 'is-invalid' : '' }}" type="text" name="lieu_arrive" id="lieu_arrive" value="{{ old('lieu_arrive', $trip->lieu_arrive) }}" required>
                @if($errors->has('lieu_arrive'))
                    <span class="text-danger">{{ $errors->first('lieu_arrive') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.lieu_arrive_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heure_arrive">{{ trans('cruds.trip.fields.heure_arrive') }}</label>
                <input class="form-control {{ $errors->has('heure_arrive') ? 'is-invalid' : '' }}" type="text" name="heure_arrive" id="heure_arrive" value="{{ old('heure_arrive', $trip->heure_arrive) }}">
                @if($errors->has('heure_arrive'))
                    <span class="text-danger">{{ $errors->first('heure_arrive') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.heure_arrive_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="liststatut_id">{{ trans('cruds.trip.fields.liststatut') }}</label>
                <select class="form-control select2 {{ $errors->has('liststatut') ? 'is-invalid' : '' }}" name="liststatut_id" id="liststatut_id">
                    @foreach($liststatuts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('liststatut_id') ? old('liststatut_id') : $trip->liststatut->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('liststatut'))
                    <span class="text-danger">{{ $errors->first('liststatut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.liststatut_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cout">{{ trans('cruds.trip.fields.cout') }}</label>
                <input class="form-control {{ $errors->has('cout') ? 'is-invalid' : '' }}" type="text" name="cout" id="cout" value="{{ old('cout', $trip->cout) }}">
                @if($errors->has('cout'))
                    <span class="text-danger">{{ $errors->first('cout') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.cout_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.trip.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $trip->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="typeoftrip_id">{{ trans('cruds.trip.fields.typeoftrip') }}</label>
                <select class="form-control select2 {{ $errors->has('typeoftrip') ? 'is-invalid' : '' }}" name="typeoftrip_id" id="typeoftrip_id" required>
                    @foreach($typeoftrips as $id => $entry)
                        <option value="{{ $id }}" {{ (old('typeoftrip_id') ? old('typeoftrip_id') : $trip->typeoftrip->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('typeoftrip'))
                    <span class="text-danger">{{ $errors->first('typeoftrip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.trip.fields.typeoftrip_helper') }}</span>
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