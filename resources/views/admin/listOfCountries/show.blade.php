@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.listOfCountry.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-of-countries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfCountry.fields.id') }}
                        </th>
                        <td>
                            {{ $listOfCountry->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfCountry.fields.intitule') }}
                        </th>
                        <td>
                            {{ $listOfCountry->intitule }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfCountry.fields.code') }}
                        </th>
                        <td>
                            {{ $listOfCountry->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.listOfCountry.fields.prefix') }}
                        </th>
                        <td>
                            {{ $listOfCountry->prefix }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.list-of-countries.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection