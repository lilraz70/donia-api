@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.setCountry.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.set-countries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.setCountry.fields.id') }}
                        </th>
                        <td>
                            {{ $setCountry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setCountry.fields.intitule') }}
                        </th>
                        <td>
                            {{ $setCountry->intitule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setCountry.fields.code') }}
                        </th>
                        <td>
                            {{ $setCountry->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setCountry.fields.prefix') }}
                        </th>
                        <td>
                            {{ $setCountry->prefix }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setCountry.fields.flag') }}
                        </th>
                        <td>
                            {{ $setCountry->flag }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setCountry.fields.statut') }}
                        </th>
                        <td>
                            {{ App\Models\SetCountry::STATUT_SELECT[$setCountry->statut] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.set-countries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#set_countries_cities" role="tab" data-toggle="tab">
                {{ trans('cruds.city.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="set_countries_cities">
            @includeIf('admin.setCountries.relationships.setCountriesCities', ['cities' => $setCountry->setCountriesCities])
        </div>
    </div>
</div>

@endsection