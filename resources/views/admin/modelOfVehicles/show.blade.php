@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.modelOfVehicle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.model-of-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.modelOfVehicle.fields.id') }}
                        </th>
                        <td>
                            {{ $modelOfVehicle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.modelOfVehicle.fields.intitule') }}
                        </th>
                        <td>
                            {{ $modelOfVehicle->intitule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.modelOfVehicle.fields.brand') }}
                        </th>
                        <td>
                            {{ $modelOfVehicle->brand->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.model-of-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection