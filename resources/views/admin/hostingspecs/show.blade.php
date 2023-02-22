@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hostingspec.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hostingspecs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingspec.fields.id') }}
                        </th>
                        <td>
                            {{ $hostingspec->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingspec.fields.lodging') }}
                        </th>
                        <td>
                            {{ $hostingspec->lodging->libelle ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingspec.fields.conveniencetype') }}
                        </th>
                        <td>
                            {{ $hostingspec->conveniencetype->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hostingspecs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection