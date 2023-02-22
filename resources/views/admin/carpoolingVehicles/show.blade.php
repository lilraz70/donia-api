@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.carpoolingVehicle.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpooling-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.id') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.finition') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->finition }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.nb_place') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->nb_place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.annee_fabrication') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->annee_fabrication }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.conso_au_100_km') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->conso_au_100_km }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.nb_chevaux') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->nb_chevaux }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.nb_cylindre') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->nb_cylindre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.accessoires') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->accessoires }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.kilometrage') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->kilometrage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.options') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->options }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.pannes_signalees') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->pannes_signalees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.immatriculation') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->immatriculation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.brand') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->brand->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.modelofvehicle') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->modelofvehicle->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.colortype') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->colortype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.energytype') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->energytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.gearbox') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->gearbox->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.vehicletype') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->vehicletype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.motricitytype') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->motricitytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.typeofwheel') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->typeofwheel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.rimtype') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->rimtype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.listofcountry') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->listofcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.user') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.typeofutility') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->typeofutility->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingVehicle.fields.libelle') }}
                        </th>
                        <td>
                            {{ $carpoolingVehicle->libelle }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpooling-vehicles.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection