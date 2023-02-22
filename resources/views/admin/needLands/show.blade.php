@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.needLand.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.need-lands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.id') }}
                        </th>
                        <td>
                            {{ $needLand->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.superficie') }}
                        </th>
                        <td>
                            {{ $needLand->superficie }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.localisation') }}
                        </th>
                        <td>
                            {{ $needLand->localisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.geolocalisation') }}
                        </th>
                        <td>
                            {{ $needLand->geolocalisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.user') }}
                        </th>
                        <td>
                            {{ $needLand->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.propertytype') }}
                        </th>
                        <td>
                            {{ $needLand->propertytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.typeoffer') }}
                        </th>
                        <td>
                            {{ $needLand->typeoffer->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.setcountry') }}
                        </th>
                        <td>
                            {{ $needLand->setcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.city') }}
                        </th>
                        <td>
                            {{ $needLand->city->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.quartier') }}
                        </th>
                        <td>
                            {{ $needLand->quartier->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.prix_vente') }}
                        </th>
                        <td>
                            {{ $needLand->prix_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.prix_location') }}
                        </th>
                        <td>
                            {{ $needLand->prix_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.condition_location') }}
                        </th>
                        <td>
                            {{ $needLand->condition_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.condition_vente') }}
                        </th>
                        <td>
                            {{ $needLand->condition_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $needLand->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.description') }}
                        </th>
                        <td>
                            {{ $needLand->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.landcategory') }}
                        </th>
                        <td>
                            {{ $needLand->landcategory->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.libelle') }}
                        </th>
                        <td>
                            {{ $needLand->libelle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.emergencylevel') }}
                        </th>
                        <td>
                            {{ $needLand->emergencylevel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.satisfait') }}
                        </th>
                        <td>
                            {{ $needLand->satisfait }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needLand.fields.date_satisfait') }}
                        </th>
                        <td>
                            {{ $needLand->date_satisfait }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.need-lands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection