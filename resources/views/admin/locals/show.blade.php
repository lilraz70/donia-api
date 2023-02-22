@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.local.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.id') }}
                        </th>
                        <td>
                            {{ $local->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.nb_chambre') }}
                        </th>
                        <td>
                            {{ $local->nb_chambre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.localisation') }}
                        </th>
                        <td>
                            {{ $local->localisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.geolocalisation') }}
                        </th>
                        <td>
                            {{ $local->geolocalisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.user') }}
                        </th>
                        <td>
                            {{ $local->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.propertytype') }}
                        </th>
                        <td>
                            {{ $local->propertytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.typeoffer') }}
                        </th>
                        <td>
                            {{ $local->typeoffer->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.setcountry') }}
                        </th>
                        <td>
                            {{ $local->setcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.city') }}
                        </th>
                        <td>
                            {{ $local->city->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.quartier') }}
                        </th>
                        <td>
                            {{ $local->quartier->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.prix_vente') }}
                        </th>
                        <td>
                            {{ $local->prix_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.prix_location') }}
                        </th>
                        <td>
                            {{ $local->prix_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.condition_location') }}
                        </th>
                        <td>
                            {{ $local->condition_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.condition_vente') }}
                        </th>
                        <td>
                            {{ $local->condition_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $local->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.description') }}
                        </th>
                        <td>
                            {{ $local->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.local.fields.libelle') }}
                        </th>
                        <td>
                            {{ $local->libelle }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.locals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection