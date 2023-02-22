@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lodging.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lodgings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.id') }}
                        </th>
                        <td>
                            {{ $lodging->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.nb_chambre') }}
                        </th>
                        <td>
                            {{ $lodging->nb_chambre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.prix_journalier') }}
                        </th>
                        <td>
                            {{ $lodging->prix_journalier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.prix_mensuel') }}
                        </th>
                        <td>
                            {{ $lodging->prix_mensuel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.localisation') }}
                        </th>
                        <td>
                            {{ $lodging->localisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.geolocalisation') }}
                        </th>
                        <td>
                            {{ $lodging->geolocalisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.hostingtype') }}
                        </th>
                        <td>
                            {{ $lodging->hostingtype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.typeofhouse') }}
                        </th>
                        <td>
                            {{ $lodging->typeofhouse->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.setcountry') }}
                        </th>
                        <td>
                            {{ $lodging->setcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.city') }}
                        </th>
                        <td>
                            {{ $lodging->city->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.quartier') }}
                        </th>
                        <td>
                            {{ $lodging->quartier->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.user') }}
                        </th>
                        <td>
                            {{ $lodging->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $lodging->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.libelle') }}
                        </th>
                        <td>
                            {{ $lodging->libelle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lodging.fields.description') }}
                        </th>
                        <td>
                            {{ $lodging->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lodgings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection