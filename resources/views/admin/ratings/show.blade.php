@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rating.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ratings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.id') }}
                        </th>
                        <td>
                            {{ $rating->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.areasofservices') }}
                        </th>
                        <td>
                            {{ $rating->areasofservices->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.objecttype') }}
                        </th>
                        <td>
                            {{ $rating->objecttype->intitule ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.user') }}
                        </th>
                        <td>
                            {{ $rating->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rating.fields.ratingtype') }}
                        </th>
                        <td>
                            {{ $rating->ratingtype->intitule ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ratings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection