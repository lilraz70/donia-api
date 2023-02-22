@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.tripFrequency.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.trip-frequencies.update", [$tripFrequency->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="day_id">{{ trans('cruds.tripFrequency.fields.day') }}</label>
                <select class="form-control select2 {{ $errors->has('day') ? 'is-invalid' : '' }}" name="day_id" id="day_id" required>
                    @foreach($days as $id => $entry)
                        <option value="{{ $id }}" {{ (old('day_id') ? old('day_id') : $tripFrequency->day->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('day'))
                    <span class="text-danger">{{ $errors->first('day') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tripFrequency.fields.day_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="trip_id">{{ trans('cruds.tripFrequency.fields.trip') }}</label>
                <select class="form-control select2 {{ $errors->has('trip') ? 'is-invalid' : '' }}" name="trip_id" id="trip_id" required>
                    @foreach($trips as $id => $entry)
                        <option value="{{ $id }}" {{ (old('trip_id') ? old('trip_id') : $tripFrequency->trip->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('trip'))
                    <span class="text-danger">{{ $errors->first('trip') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.tripFrequency.fields.trip_helper') }}</span>
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