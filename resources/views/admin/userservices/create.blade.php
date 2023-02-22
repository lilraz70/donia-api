@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userservice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.userservices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userservice.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userservice.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="areasofservice_id">{{ trans('cruds.userservice.fields.areasofservice') }}</label>
                <select class="form-control select2 {{ $errors->has('areasofservice') ? 'is-invalid' : '' }}" name="areasofservice_id" id="areasofservice_id" required>
                    @foreach($areasofservices as $id => $entry)
                        <option value="{{ $id }}" {{ old('areasofservice_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('areasofservice'))
                    <span class="text-danger">{{ $errors->first('areasofservice') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.userservice.fields.areasofservice_helper') }}</span>
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