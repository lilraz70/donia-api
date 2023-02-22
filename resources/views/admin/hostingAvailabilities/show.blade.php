@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hostingAvailability.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hosting-availabilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingAvailability.fields.id') }}
                        </th>
                        <td>
                            {{ $hostingAvailability->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingAvailability.fields.jour_debut') }}
                        </th>
                        <td>
                            {{ $hostingAvailability->jour_debut }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingAvailability.fields.heure_debut') }}
                        </th>
                        <td>
                            {{ $hostingAvailability->heure_debut }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingAvailability.fields.jour_fin') }}
                        </th>
                        <td>
                            {{ $hostingAvailability->jour_fin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingAvailability.fields.heure_fin') }}
                        </th>
                        <td>
                            {{ $hostingAvailability->heure_fin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingAvailability.fields.lodging') }}
                        </th>
                        <td>
                            {{ $hostingAvailability->lodging->libelle ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hosting-availabilities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection