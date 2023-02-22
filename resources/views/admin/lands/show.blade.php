@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.land.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.id') }}
                        </th>
                        <td>
                            {{ $land->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.superficie') }}
                        </th>
                        <td>
                            {{ $land->superficie }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.localisation') }}
                        </th>
                        <td>
                            {{ $land->localisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.geolocalisation') }}
                        </th>
                        <td>
                            {{ $land->geolocalisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.user') }}
                        </th>
                        <td>
                            {{ $land->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.propertytype') }}
                        </th>
                        <td>
                            {{ $land->propertytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.typeoffer') }}
                        </th>
                        <td>
                            {{ $land->typeoffer->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.setcountry') }}
                        </th>
                        <td>
                            {{ $land->setcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.city') }}
                        </th>
                        <td>
                            {{ $land->city->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.quartier') }}
                        </th>
                        <td>
                            {{ $land->quartier->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.prix_vente') }}
                        </th>
                        <td>
                            {{ $land->prix_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.prix_location') }}
                        </th>
                        <td>
                            {{ $land->prix_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.condition_location') }}
                        </th>
                        <td>
                            {{ $land->condition_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.condition_vente') }}
                        </th>
                        <td>
                            {{ $land->condition_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $land->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.description') }}
                        </th>
                        <td>
                            {{ $land->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.landcategory') }}
                        </th>
                        <td>
                            {{ $land->landcategory->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.land.fields.libelle') }}
                        </th>
                        <td>
                            {{ $land->libelle }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection