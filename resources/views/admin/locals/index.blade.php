@extends('layouts.admin')
@section('content')
@can('local_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.locals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.local.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Local', 'route' => 'admin.locals.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.local.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Local">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.local.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.nb_chambre') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.localisation') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.geolocalisation') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.propertytype') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.typeoffer') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.setcountry') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.quartier') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.prix_vente') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.prix_location') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.condition_location') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.condition_vente') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.liststatut') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.local.fields.libelle') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($property_types as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($type_offers as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($set_countries as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($cities as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($quartiers as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($list_statuts as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('local_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.locals.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.locals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'nb_chambre', name: 'nb_chambre' },
{ data: 'localisation', name: 'localisation' },
{ data: 'geolocalisation', name: 'geolocalisation' },
{ data: 'user_name', name: 'user.name' },
{ data: 'propertytype_intitule', name: 'propertytype.intitule' },
{ data: 'typeoffer_intitule', name: 'typeoffer.intitule' },
{ data: 'setcountry_intitule', name: 'setcountry.intitule' },
{ data: 'city_intitule', name: 'city.intitule' },
{ data: 'quartier_intitule', name: 'quartier.intitule' },
{ data: 'prix_vente', name: 'prix_vente' },
{ data: 'prix_location', name: 'prix_location' },
{ data: 'condition_location', name: 'condition_location' },
{ data: 'condition_vente', name: 'condition_vente' },
{ data: 'liststatut_intitule', name: 'liststatut.intitule' },
{ data: 'description', name: 'description' },
{ data: 'libelle', name: 'libelle' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Local').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection