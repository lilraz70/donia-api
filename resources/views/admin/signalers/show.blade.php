@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.signaler.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.signalers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.signaler.fields.id') }}
                        </th>
                        <td>
                            {{ $signaler->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signaler.fields.experience_utilisateur') }}
                        </th>
                        <td>
                            {{ $signaler->experience_utilisateur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signaler.fields.comment') }}
                        </th>
                        <td>
                            {{ $signaler->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signaler.fields.objet') }}
                        </th>
                        <td>
                            {{ $signaler->objet }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signaler.fields.user') }}
                        </th>
                        <td>
                            {{ $signaler->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signaler.fields.objecttype') }}
                        </th>
                        <td>
                            {{ $signaler->objecttype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signaler.fields.reason') }}
                        </th>
                        <td>
                            {{ $signaler->reason->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.signalers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection