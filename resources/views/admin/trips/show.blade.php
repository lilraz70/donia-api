@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.trip.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.id') }}
                        </th>
                        <td>
                            {{ $trip->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.intitule') }}
                        </th>
                        <td>
                            {{ $trip->intitule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.lieu_depart') }}
                        </th>
                        <td>
                            {{ $trip->lieu_depart }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.heure_depart') }}
                        </th>
                        <td>
                            {{ $trip->heure_depart }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.lieu_arrive') }}
                        </th>
                        <td>
                            {{ $trip->lieu_arrive }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.heure_arrive') }}
                        </th>
                        <td>
                            {{ $trip->heure_arrive }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $trip->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.cout') }}
                        </th>
                        <td>
                            {{ $trip->cout }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.user') }}
                        </th>
                        <td>
                            {{ $trip->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.trip.fields.typeoftrip') }}
                        </th>
                        <td>
                            {{ $trip->typeoftrip->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.trips.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection