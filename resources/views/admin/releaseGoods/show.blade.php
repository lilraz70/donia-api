@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.releaseGood.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.release-goods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.id') }}
                        </th>
                        <td>
                            {{ $releaseGood->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.date_sorti_prevu') }}
                        </th>
                        <td>
                            {{ $releaseGood->date_sorti_prevu }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.conditions_bailleur') }}
                        </th>
                        <td>
                            {{ $releaseGood->conditions_bailleur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.commentaires') }}
                        </th>
                        <td>
                            {{ $releaseGood->commentaires }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.nb_chambre') }}
                        </th>
                        <td>
                            {{ $releaseGood->nb_chambre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.localisation') }}
                        </th>
                        <td>
                            {{ $releaseGood->localisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.geolocalisation') }}
                        </th>
                        <td>
                            {{ $releaseGood->geolocalisation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.date_limite') }}
                        </th>
                        <td>
                            {{ $releaseGood->date_limite }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.contact_bailleur') }}
                        </th>
                        <td>
                            {{ $releaseGood->contact_bailleur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.accord_bailleur') }}
                        </th>
                        <td>
                            {{ $releaseGood->accord_bailleur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.propertytype') }}
                        </th>
                        <td>
                            {{ $releaseGood->propertytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.setcountry') }}
                        </th>
                        <td>
                            {{ $releaseGood->setcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.city') }}
                        </th>
                        <td>
                            {{ $releaseGood->city->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.quartier') }}
                        </th>
                        <td>
                            {{ $releaseGood->quartier->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.user') }}
                        </th>
                        <td>
                            {{ $releaseGood->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $releaseGood->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.emergencylevel') }}
                        </th>
                        <td>
                            {{ $releaseGood->emergencylevel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.libelle') }}
                        </th>
                        <td>
                            {{ $releaseGood->libelle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.verif_accord_bailleur') }}
                        </th>
                        <td>
                            {{ App\Models\ReleaseGood::VERIF_ACCORD_BAILLEUR_RADIO[$releaseGood->verif_accord_bailleur] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.cout') }}
                        </th>
                        <td>
                            {{ $releaseGood->cout }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.releaseGood.fields.loyer_augmentera') }}
                        </th>
                        <td>
                            {{ App\Models\ReleaseGood::LOYER_AUGMENTERA_RADIO[$releaseGood->loyer_augmentera] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.release-goods.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection