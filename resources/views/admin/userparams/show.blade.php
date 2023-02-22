@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userparam.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.userparams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userparam.fields.id') }}
                        </th>
                        <td>
                            {{ $userparam->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userparam.fields.user') }}
                        </th>
                        <td>
                            {{ $userparam->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userparam.fields.parameterusertype') }}
                        </th>
                        <td>
                            {{ $userparam->parameterusertype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userparam.fields.param_value') }}
                        </th>
                        <td>
                            {{ $userparam->param_value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.userparams.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection