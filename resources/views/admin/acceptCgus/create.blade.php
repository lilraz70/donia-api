@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.acceptCgu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.accept-cgus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="deviceinfo">{{ trans('cruds.acceptCgu.fields.deviceinfo') }}</label>
                <input class="form-control {{ $errors->has('deviceinfo') ? 'is-invalid' : '' }}" type="text" name="deviceinfo" id="deviceinfo" value="{{ old('deviceinfo', '') }}" required>
                @if($errors->has('deviceinfo'))
                    <span class="text-danger">{{ $errors->first('deviceinfo') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.acceptCgu.fields.deviceinfo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.acceptCgu.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.acceptCgu.fields.user_helper') }}</span>
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