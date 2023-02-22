@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.quartier.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.quartiers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.quartier.fields.id') }}
                        </th>
                        <td>
                            {{ $quartier->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quartier.fields.intitule') }}
                        </th>
                        <td>
                            {{ $quartier->intitule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quartier.fields.set_countries') }}
                        </th>
                        <td>
                            {{ $quartier->set_countries->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.quartier.fields.city') }}
                        </th>
                        <td>
                            {{ $quartier->city->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.quartiers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection