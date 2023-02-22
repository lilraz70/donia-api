@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.allmedia.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.allmedias.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.allmedia.fields.id') }}
                        </th>
                        <td>
                            {{ $allmedia->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allmedia.fields.lien_ressources') }}
                        </th>
                        <td>
                            @if($allmedia->lien_ressources)
                                <a href="{{ $allmedia->lien_ressources->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allmedia.fields.etiquettes') }}
                        </th>
                        <td>
                            {{ $allmedia->etiquettes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allmedia.fields.description') }}
                        </th>
                        <td>
                            {{ $allmedia->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allmedia.fields.objecttype') }}
                        </th>
                        <td>
                            {{ $allmedia->objecttype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allmedia.fields.typeofmedia') }}
                        </th>
                        <td>
                            {{ $allmedia->typeofmedia->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.allmedia.fields.objet') }}
                        </th>
                        <td>
                            {{ $allmedia->objet }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.allmedias.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection