@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vehicleAvailability.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vehicle-availabilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleAvailability.fields.id') }}
                        </th>
                        <td>
                            {{ $vehicleAvailability->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleAvailability.fields.jour_debut') }}
                        </th>
                        <td>
                            {{ $vehicleAvailability->jour_debut }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleAvailability.fields.heure_debut') }}
                        </th>
                        <td>
                            {{ $vehicleAvailability->heure_debut }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleAvailability.fields.jour_fin') }}
                        </th>
                        <td>
                            {{ $vehicleAvailability->jour_fin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleAvailability.fields.heure_fin') }}
                        </th>
                        <td>
                            {{ $vehicleAvailability->heure_fin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vehicleAvailability.fields.sellrentcar') }}
                        </th>
                        <td>
                            {{ $vehicleAvailability->sellrentcar->libelle ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.vehicle-availabilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection