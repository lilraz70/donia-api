@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bookreleasegood.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bookreleasegoods.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="releasegood_id">{{ trans('cruds.bookreleasegood.fields.releasegood') }}</label>
                <select class="form-control select2 {{ $errors->has('releasegood') ? 'is-invalid' : '' }}" name="releasegood_id" id="releasegood_id" required>
                    @foreach($releasegoods as $id => $entry)
                        <option value="{{ $id }}" {{ old('releasegood_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('releasegood'))
                    <span class="text-danger">{{ $errors->first('releasegood') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookreleasegood.fields.releasegood_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.bookreleasegood.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookreleasegood.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.bookreleasegood.fields.confirmation') }}</label>
                @foreach(App\Models\Bookreleasegood::CONFIRMATION_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('confirmation') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="confirmation_{{ $key }}" name="confirmation" value="{{ $key }}" {{ old('confirmation', '0') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="confirmation_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('confirmation'))
                    <span class="text-danger">{{ $errors->first('confirmation') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bookreleasegood.fields.confirmation_helper') }}</span>
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