@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hostingService.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hosting-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingService.fields.id') }}
                        </th>
                        <td>
                            {{ $hostingService->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingService.fields.lodging') }}
                        </th>
                        <td>
                            {{ $hostingService->lodging->libelle ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hostingService.fields.servicesinclus') }}
                        </th>
                        <td>
                            {{ $hostingService->servicesinclus->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.hosting-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection