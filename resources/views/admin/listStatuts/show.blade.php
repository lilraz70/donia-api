@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.listStatut.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-statuts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.listStatut.fields.id') }}
                        </th>
                        <td>
                            {{ $listStatut->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listStatut.fields.intitule') }}
                        </th>
                        <td>
                            {{ $listStatut->intitule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listStatut.fields.objecttype') }}
                        </th>
                        <td>
                            {{ $listStatut->objecttype->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-statuts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection