@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.carpool.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.id') }}
                        </th>
                        <td>
                            {{ $carpool->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.user_client') }}
                        </th>
                        <td>
                            {{ $carpool->user_client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.user_fournisseur') }}
                        </th>
                        <td>
                            {{ $carpool->user_fournisseur->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.paiement') }}
                        </th>
                        <td>
                            {{ $carpool->paiement }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.preuve_paiement') }}
                        </th>
                        <td>
                            {{ $carpool->preuve_paiement }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.paymentmode') }}
                        </th>
                        <td>
                            {{ $carpool->paymentmode->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.mention_arrive') }}
                        </th>
                        <td>
                            {{ $carpool->mention_arrive }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.mention_arv_heure') }}
                        </th>
                        <td>
                            {{ $carpool->mention_arv_heure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.trip') }}
                        </th>
                        <td>
                            {{ $carpool->trip->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $carpool->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpool.fields.carpoolingvehicle') }}
                        </th>
                        <td>
                            {{ $carpool->carpoolingvehicle->libelle ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection