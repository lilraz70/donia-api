@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.releaseGoodConvenience.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.release-good-conveniences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGoodConvenience.fields.id') }}
                        </th>
                        <td>
                            {{ $releaseGoodConvenience->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGoodConvenience.fields.releasegood') }}
                        </th>
                        <td>
                            {{ $releaseGoodConvenience->releasegood->libelle ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGoodConvenience.fields.conveniencetype') }}
                        </th>
                        <td>
                            {{ $releaseGoodConvenience->conveniencetype->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.release-good-conveniences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection