@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.localConvenience.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.local-conveniences.update", [$localConvenience->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="local_id">{{ trans('cruds.localConvenience.fields.local') }}</label>
                <select class="form-control select2 {{ $errors->has('local') ? 'is-invalid' : '' }}" name="local_id" id="local_id" required>
                    @foreach($locals as $id => $entry)
                        <option value="{{ $id }}" {{ (old('local_id') ? old('local_id') : $localConvenience->local->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('local'))
                    <span class="text-danger">{{ $errors->first('local') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localConvenience.fields.local_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="conveniencetype_id">{{ trans('cruds.localConvenience.fields.conveniencetype') }}</label>
                <select class="form-control select2 {{ $errors->has('conveniencetype') ? 'is-invalid' : '' }}" name="conveniencetype_id" id="conveniencetype_id" required>
                    @foreach($conveniencetypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('conveniencetype_id') ? old('conveniencetype_id') : $localConvenience->conveniencetype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('conveniencetype'))
                    <span class="text-danger">{{ $errors->first('conveniencetype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.localConvenience.fields.conveniencetype_helper') }}</span>
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