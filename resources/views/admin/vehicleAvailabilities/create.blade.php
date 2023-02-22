@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vehicleAvailability.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vehicle-availabilities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="jour_debut">{{ trans('cruds.vehicleAvailability.fields.jour_debut') }}</label>
                <input class="form-control date {{ $errors->has('jour_debut') ? 'is-invalid' : '' }}" type="text" name="jour_debut" id="jour_debut" value="{{ old('jour_debut') }}" required>
                @if($errors->has('jour_debut'))
                    <span class="text-danger">{{ $errors->first('jour_debut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vehicleAvailability.fields.jour_debut_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heure_debut">{{ trans('cruds.vehicleAvailability.fields.heure_debut') }}</label>
                <input class="form-control timepicker {{ $errors->has('heure_debut') ? 'is-invalid' : '' }}" type="text" name="heure_debut" id="heure_debut" value="{{ old('heure_debut') }}">
                @if($errors->has('heure_debut'))
                    <span class="text-danger">{{ $errors->first('heure_debut') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vehicleAvailability.fields.heure_debut_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jour_fin">{{ trans('cruds.vehicleAvailability.fields.jour_fin') }}</label>
                <input class="form-control date {{ $errors->has('jour_fin') ? 'is-invalid' : '' }}" type="text" name="jour_fin" id="jour_fin" value="{{ old('jour_fin') }}">
                @if($errors->has('jour_fin'))
                    <span class="text-danger">{{ $errors->first('jour_fin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vehicleAvailability.fields.jour_fin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heure_fin">{{ trans('cruds.vehicleAvailability.fields.heure_fin') }}</label>
                <input class="form-control timepicker {{ $errors->has('heure_fin') ? 'is-invalid' : '' }}" type="text" name="heure_fin" id="heure_fin" value="{{ old('heure_fin') }}">
                @if($errors->has('heure_fin'))
                    <span class="text-danger">{{ $errors->first('heure_fin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vehicleAvailability.fields.heure_fin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sellrentcar_id">{{ trans('cruds.vehicleAvailability.fields.sellrentcar') }}</label>
                <select class="form-control select2 {{ $errors->has('sellrentcar') ? 'is-invalid' : '' }}" name="sellrentcar_id" id="sellrentcar_id" required>
                    @foreach($sellrentcars as $id => $entry)
                        <option value="{{ $id }}" {{ old('sellrentcar_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('sellrentcar'))
                    <span class="text-danger">{{ $errors->first('sellrentcar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.vehicleAvailability.fields.sellrentcar_helper') }}</span>
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