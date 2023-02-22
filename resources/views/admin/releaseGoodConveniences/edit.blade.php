@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.releaseGoodConvenience.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.release-good-conveniences.update", [$releaseGoodConvenience->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="releasegood_id">{{ trans('cruds.releaseGoodConvenience.fields.releasegood') }}</label>
                <select class="form-control select2 {{ $errors->has('releasegood') ? 'is-invalid' : '' }}" name="releasegood_id" id="releasegood_id" required>
                    @foreach($releasegoods as $id => $entry)
                        <option value="{{ $id }}" {{ (old('releasegood_id') ? old('releasegood_id') : $releaseGoodConvenience->releasegood->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('releasegood'))
                    <span class="text-danger">{{ $errors->first('releasegood') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGoodConvenience.fields.releasegood_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="conveniencetype_id">{{ trans('cruds.releaseGoodConvenience.fields.conveniencetype') }}</label>
                <select class="form-control select2 {{ $errors->has('conveniencetype') ? 'is-invalid' : '' }}" name="conveniencetype_id" id="conveniencetype_id" required>
                    @foreach($conveniencetypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('conveniencetype_id') ? old('conveniencetype_id') : $releaseGoodConvenience->conveniencetype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('conveniencetype'))
                    <span class="text-danger">{{ $errors->first('conveniencetype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.releaseGoodConvenience.fields.conveniencetype_helper') }}</span>
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