@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rating.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ratings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="areasofservices_id">{{ trans('cruds.rating.fields.areasofservices') }}</label>
                <select class="form-control select2 {{ $errors->has('areasofservices') ? 'is-invalid' : '' }}" name="areasofservices_id" id="areasofservices_id" required>
                    @foreach($areasofservices as $id => $entry)
                        <option value="{{ $id }}" {{ old('areasofservices_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('areasofservices'))
                    <span class="text-danger">{{ $errors->first('areasofservices') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.areasofservices_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="objecttype_id">{{ trans('cruds.rating.fields.objecttype') }}</label>
                <select class="form-control select2 {{ $errors->has('objecttype') ? 'is-invalid' : '' }}" name="objecttype_id" id="objecttype_id" required>
                    @foreach($objecttypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('objecttype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('objecttype'))
                    <span class="text-danger">{{ $errors->first('objecttype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.objecttype_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.rating.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ratingtype_id">{{ trans('cruds.rating.fields.ratingtype') }}</label>
                <select class="form-control select2 {{ $errors->has('ratingtype') ? 'is-invalid' : '' }}" name="ratingtype_id" id="ratingtype_id" required>
                    @foreach($ratingtypes as $id => $entry)
                        <option value="{{ $id }}" {{ old('ratingtype_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ratingtype'))
                    <span class="text-danger">{{ $errors->first('ratingtype') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.rating.fields.ratingtype_helper') }}</span>
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