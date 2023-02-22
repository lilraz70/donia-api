@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.favori.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.favoris.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.favori.fields.id') }}
                        </th>
                        <td>
                            {{ $favori->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.favori.fields.object') }}
                        </th>
                        <td>
                            {{ $favori->object }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.favori.fields.objecttype') }}
                        </th>
                        <td>
                            {{ $favori->objecttype->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.favoris.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection