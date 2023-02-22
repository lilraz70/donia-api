@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.landDoc.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.land-docs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.landDoc.fields.id') }}
                        </th>
                        <td>
                            {{ $landDoc->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landDoc.fields.land') }}
                        </th>
                        <td>
                            {{ $landDoc->land->libelle ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.landDoc.fields.typeadmdoc') }}
                        </th>
                        <td>
                            {{ $landDoc->typeadmdoc->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.land-docs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection