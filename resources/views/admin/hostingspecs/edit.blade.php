@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hostingspec.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.hostingspecs.update", [$hostingspec->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lodging_id">{{ trans('cruds.hostingspec.fields.lodging') }}</label>
                <select class="form-control select2 {{ $errors->has('lodging') ? 'is-invalid' : '' }}" name="lodging_id" id="lodging_id" required>
                    @foreach($lodgings as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lodging_id') ? old('lodging_id') : $hostingspec->lodging->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lodging'))
                    <span class="text-danger">{{ $errors->first('lodging') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hostingspec.fields.lodging_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="conveniencetype_id">{{ trans('cruds.hostingspec.fields.conveniencetype') }}</label>
                <select class="form-control select2 {{ $errors->has('conveniencetype') ? 'is-invalid' : '' }}" name="conveniencetype_id" id="conveniencetype_id" required>
                    @foreach($conveniencetypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('conveniencetype_id') ? old('conveniencetype_id') : $hostingspec->conveniencetype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('conveniencetype'))
                    <span class="text-danger">{{ $errors->first('conveniencetype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.hostingspec.fields.conveniencetype_helper') }}</span>
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