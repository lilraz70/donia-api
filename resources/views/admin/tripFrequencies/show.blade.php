@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tripFrequency.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trip-frequencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tripFrequency.fields.id') }}
                        </th>
                        <td>
                            {{ $tripFrequency->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tripFrequency.fields.day') }}
                        </th>
                        <td>
                            {{ $tripFrequency->day->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tripFrequency.fields.trip') }}
                        </th>
                        <td>
                            {{ $tripFrequency->trip->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trip-frequencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection