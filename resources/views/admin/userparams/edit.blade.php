@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userparam.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.userparams.update", [$userparam->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userparam.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userparam->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userparam.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="parameterusertype_id">{{ trans('cruds.userparam.fields.parameterusertype') }}</label>
                <select class="form-control select2 {{ $errors->has('parameterusertype') ? 'is-invalid' : '' }}" name="parameterusertype_id" id="parameterusertype_id" required>
                    @foreach($parameterusertypes as $id => $entry)
                        <option value="{{ $id }}" {{ (old('parameterusertype_id') ? old('parameterusertype_id') : $userparam->parameterusertype->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('parameterusertype'))
                    <span class="text-danger">{{ $errors->first('parameterusertype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userparam.fields.parameterusertype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="param_value">{{ trans('cruds.userparam.fields.param_value') }}</label>
                <input class="form-control {{ $errors->has('param_value') ? 'is-invalid' : '' }}" type="text" name="param_value" id="param_value" value="{{ old('param_value', $userparam->param_value) }}" required>
                @if($errors->has('param_value'))
                    <span class="text-danger">{{ $errors->first('param_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userparam.fields.param_value_helper') }}</span>
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