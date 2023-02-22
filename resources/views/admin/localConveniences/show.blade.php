@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.localConvenience.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.local-conveniences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.localConvenience.fields.id') }}
                        </th>
                        <td>
                            {{ $localConvenience->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localConvenience.fields.local') }}
                        </th>
                        <td>
                            {{ $localConvenience->local->libelle ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.localConvenience.fields.conveniencetype') }}
                        </th>
                        <td>
                            {{ $localConvenience->conveniencetype->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.local-conveniences.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection