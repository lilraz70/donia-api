@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.besoinHebergement.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.besoin-hebergements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.id') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.nb_chambre') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->nb_chambre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.prix_journalier') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->prix_journalier }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.prix_mensuel') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->prix_mensuel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.localisation') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->localisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.geolocalisation') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->geolocalisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.hostingtype') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->hostingtype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.typeofhouse') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->typeofhouse->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.setcountry') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->setcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.city') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->city->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.quartier') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->quartier->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.user') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.libelle') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->libelle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.description') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.emergencylevel') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->emergencylevel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.satisfait') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->satisfait }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.date_satisfait') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->date_satisfait }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.conveniences') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->conveniences }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.besoinHebergement.fields.servicesinclus') }}
                        </th>
                        <td>
                            {{ $besoinHebergement->servicesinclus }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.besoin-hebergements.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection