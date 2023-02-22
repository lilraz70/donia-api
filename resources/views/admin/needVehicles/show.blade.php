@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.needVehicle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.need-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.id') }}
                        </th>
                        <td>
                            {{ $needVehicle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.finition') }}
                        </th>
                        <td>
                            {{ $needVehicle->finition }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.nb_place') }}
                        </th>
                        <td>
                            {{ $needVehicle->nb_place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.annee_fabrication') }}
                        </th>
                        <td>
                            {{ $needVehicle->annee_fabrication }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.conso_au_100_km') }}
                        </th>
                        <td>
                            {{ $needVehicle->conso_au_100_km }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.nb_chevaux') }}
                        </th>
                        <td>
                            {{ $needVehicle->nb_chevaux }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.nb_cylindre') }}
                        </th>
                        <td>
                            {{ $needVehicle->nb_cylindre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.accessoires') }}
                        </th>
                        <td>
                            {{ $needVehicle->accessoires }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.kilometrage') }}
                        </th>
                        <td>
                            {{ $needVehicle->kilometrage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.options') }}
                        </th>
                        <td>
                            {{ $needVehicle->options }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.pannes_signalees') }}
                        </th>
                        <td>
                            {{ $needVehicle->pannes_signalees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.immatriculation') }}
                        </th>
                        <td>
                            {{ $needVehicle->immatriculation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.brand') }}
                        </th>
                        <td>
                            {{ $needVehicle->brand->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.modelofvehicle') }}
                        </th>
                        <td>
                            {{ $needVehicle->modelofvehicle->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.colortype') }}
                        </th>
                        <td>
                            {{ $needVehicle->colortype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.energytype') }}
                        </th>
                        <td>
                            {{ $needVehicle->energytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.gearbox') }}
                        </th>
                        <td>
                            {{ $needVehicle->gearbox->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.vehicletype') }}
                        </th>
                        <td>
                            {{ $needVehicle->vehicletype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.typeofutility') }}
                        </th>
                        <td>
                            {{ $needVehicle->typeofutility->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.motricitytype') }}
                        </th>
                        <td>
                            {{ $needVehicle->motricitytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.typeofwheel') }}
                        </th>
                        <td>
                            {{ $needVehicle->typeofwheel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.rimtype') }}
                        </th>
                        <td>
                            {{ $needVehicle->rimtype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.listofcountry') }}
                        </th>
                        <td>
                            {{ $needVehicle->listofcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.user') }}
                        </th>
                        <td>
                            {{ $needVehicle->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $needVehicle->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.typeoffer') }}
                        </th>
                        <td>
                            {{ $needVehicle->typeoffer->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.budget_max_achat') }}
                        </th>
                        <td>
                            {{ $needVehicle->budget_max_achat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.budget_max_location') }}
                        </th>
                        <td>
                            {{ $needVehicle->budget_max_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.description') }}
                        </th>
                        <td>
                            {{ $needVehicle->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.libelle') }}
                        </th>
                        <td>
                            {{ $needVehicle->libelle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.emergencylevel') }}
                        </th>
                        <td>
                            {{ $needVehicle->emergencylevel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.date_limite_demande') }}
                        </th>
                        <td>
                            {{ $needVehicle->date_limite_demande }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.satisfait') }}
                        </th>
                        <td>
                            {{ $needVehicle->satisfait }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.needVehicle.fields.date_satisfait') }}
                        </th>
                        <td>
                            {{ $needVehicle->date_satisfait }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.need-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection