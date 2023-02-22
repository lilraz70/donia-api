@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.hostingService.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hosting-services.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="lodging_id">{{ trans('cruds.hostingService.fields.lodging') }}</label>
                <select class="form-control select2 {{ $errors->has('lodging') ? 'is-invalid' : '' }}" name="lodging_id" id="lodging_id" required>
                    @foreach($lodgings as $id => $entry)
                        <option value="{{ $id }}" {{ old('lodging_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lodging'))
                    <span class="text-danger">{{ $errors->first('lodging') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hostingService.fields.lodging_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="servicesinclus_id">{{ trans('cruds.hostingService.fields.servicesinclus') }}</label>
                <select class="form-control select2 {{ $errors->has('servicesinclus') ? 'is-invalid' : '' }}" name="servicesinclus_id" id="servicesinclus_id" required>
                    @foreach($servicesincluses as $id => $entry)
                        <option value="{{ $id }}" {{ old('servicesinclus_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('servicesinclus'))
                    <span class="text-danger">{{ $errors->first('servicesinclus') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hostingService.fields.servicesinclus_helper') }}</span>
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