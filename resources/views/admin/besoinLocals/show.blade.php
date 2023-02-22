@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.besoinLocal.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.besoin-locals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.id') }}
                        </th>
                        <td>
                            {{ $besoinLocal->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.nb_chambre') }}
                        </th>
                        <td>
                            {{ $besoinLocal->nb_chambre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.localisation') }}
                        </th>
                        <td>
                            {{ $besoinLocal->localisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.geolocalisation') }}
                        </th>
                        <td>
                            {{ $besoinLocal->geolocalisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.user') }}
                        </th>
                        <td>
                            {{ $besoinLocal->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.propertytype') }}
                        </th>
                        <td>
                            {{ $besoinLocal->propertytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.typeoffer') }}
                        </th>
                        <td>
                            {{ $besoinLocal->typeoffer->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.setcountry') }}
                        </th>
                        <td>
                            {{ $besoinLocal->setcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.city') }}
                        </th>
                        <td>
                            {{ $besoinLocal->city->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.quartier') }}
                        </th>
                        <td>
                            {{ $besoinLocal->quartier->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.condition_location') }}
                        </th>
                        <td>
                            {{ $besoinLocal->condition_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.condition_vente') }}
                        </th>
                        <td>
                            {{ $besoinLocal->condition_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $besoinLocal->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.description') }}
                        </th>
                        <td>
                            {{ $besoinLocal->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.libelle') }}
                        </th>
                        <td>
                            {{ $besoinLocal->libelle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.date_limite_demande') }}
                        </th>
                        <td>
                            {{ $besoinLocal->date_limite_demande }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.budget_max_achat') }}
                        </th>
                        <td>
                            {{ $besoinLocal->budget_max_achat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.budget_max_location') }}
                        </th>
                        <td>
                            {{ $besoinLocal->budget_max_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.emergencylevel') }}
                        </th>
                        <td>
                            {{ $besoinLocal->emergencylevel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.satisfait') }}
                        </th>
                        <td>
                            {{ $besoinLocal->satisfait }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinLocal.fields.date_satisfait') }}
                        </th>
                        <td>
                            {{ $besoinLocal->date_satisfait }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.besoin-locals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection