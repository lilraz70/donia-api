@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sellRentCar.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sell-rent-cars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.id') }}
                        </th>
                        <td>
                            {{ $sellRentCar->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.finition') }}
                        </th>
                        <td>
                            {{ $sellRentCar->finition }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.nb_place') }}
                        </th>
                        <td>
                            {{ $sellRentCar->nb_place }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.annee_fabrication') }}
                        </th>
                        <td>
                            {{ $sellRentCar->annee_fabrication }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.conso_au_100_km') }}
                        </th>
                        <td>
                            {{ $sellRentCar->conso_au_100_km }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.nb_chevaux') }}
                        </th>
                        <td>
                            {{ $sellRentCar->nb_chevaux }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.nb_cylindre') }}
                        </th>
                        <td>
                            {{ $sellRentCar->nb_cylindre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.accessoires') }}
                        </th>
                        <td>
                            {{ $sellRentCar->accessoires }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.kilometrage') }}
                        </th>
                        <td>
                            {{ $sellRentCar->kilometrage }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.options') }}
                        </th>
                        <td>
                            {{ $sellRentCar->options }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.pannes_signalees') }}
                        </th>
                        <td>
                            {{ $sellRentCar->pannes_signalees }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.immatriculation') }}
                        </th>
                        <td>
                            {{ $sellRentCar->immatriculation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.brand') }}
                        </th>
                        <td>
                            {{ $sellRentCar->brand->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.modelofvehicle') }}
                        </th>
                        <td>
                            {{ $sellRentCar->modelofvehicle->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.colortype') }}
                        </th>
                        <td>
                            {{ $sellRentCar->colortype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.energytype') }}
                        </th>
                        <td>
                            {{ $sellRentCar->energytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.gearbox') }}
                        </th>
                        <td>
                            {{ $sellRentCar->gearbox->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.vehicletype') }}
                        </th>
                        <td>
                            {{ $sellRentCar->vehicletype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.typeofutility') }}
                        </th>
                        <td>
                            {{ $sellRentCar->typeofutility->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.motricitytype') }}
                        </th>
                        <td>
                            {{ $sellRentCar->motricitytype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.typeofwheel') }}
                        </th>
                        <td>
                            {{ $sellRentCar->typeofwheel->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.rimtype') }}
                        </th>
                        <td>
                            {{ $sellRentCar->rimtype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.listofcountry') }}
                        </th>
                        <td>
                            {{ $sellRentCar->listofcountry->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.user') }}
                        </th>
                        <td>
                            {{ $sellRentCar->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.liststatut') }}
                        </th>
                        <td>
                            {{ $sellRentCar->liststatut->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.typeoffer') }}
                        </th>
                        <td>
                            {{ $sellRentCar->typeoffer->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.prix_vente') }}
                        </th>
                        <td>
                            {{ $sellRentCar->prix_vente }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.prix_location') }}
                        </th>
                        <td>
                            {{ $sellRentCar->prix_location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.description') }}
                        </th>
                        <td>
                            {{ $sellRentCar->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sellRentCar.fields.libelle') }}
                        </th>
                        <td>
                            {{ $sellRentCar->libelle }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sell-rent-cars.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection