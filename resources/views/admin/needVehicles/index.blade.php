@extends('layouts.admin')
@section('content')
@can('need_vehicle_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.need-vehicles.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.needVehicle.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'NeedVehicle', 'route' => 'admin.need-vehicles.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.needVehicle.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-NeedVehicle">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.finition') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.nb_place') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.annee_fabrication') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.conso_au_100_km') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.nb_chevaux') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.nb_cylindre') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.accessoires') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.kilometrage') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.options') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.pannes_signalees') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.immatriculation') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.brand') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.modelofvehicle') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.colortype') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.energytype') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.gearbox') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.vehicletype') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.typeofutility') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.motricitytype') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.typeofwheel') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.rimtype') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.listofcountry') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.liststatut') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.typeoffer') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.budget_max_achat') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.budget_max_location') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.libelle') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.emergencylevel') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.date_limite_demande') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.satisfait') }}
                    </th>
                    <th>
                        {{ trans('cruds.needVehicle.fields.date_satisfait') }}
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
                            @foreach($brands as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($model_of_vehicles as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($color_types as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($energy_types as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($gear_boxes as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($vehicle_types as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($type_of_utilities as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($motricity_types as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($type_of_wheels as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($rim_types as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($list_of_countries as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
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
                            @foreach($list_statuts as $key => $item)
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
                            @foreach($emergency_levels as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
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
@can('need_vehicle_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.need-vehicles.massDestroy') }}",
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
    ajax: "{{ route('admin.need-vehicles.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'finition', name: 'finition' },
{ data: 'nb_place', name: 'nb_place' },
{ data: 'annee_fabrication', name: 'annee_fabrication' },
{ data: 'conso_au_100_km', name: 'conso_au_100_km' },
{ data: 'nb_chevaux', name: 'nb_chevaux' },
{ data: 'nb_cylindre', name: 'nb_cylindre' },
{ data: 'accessoires', name: 'accessoires' },
{ data: 'kilometrage', name: 'kilometrage' },
{ data: 'options', name: 'options' },
{ data: 'pannes_signalees', name: 'pannes_signalees' },
{ data: 'immatriculation', name: 'immatriculation' },
{ data: 'brand_intitule', name: 'brand.intitule' },
{ data: 'modelofvehicle_intitule', name: 'modelofvehicle.intitule' },
{ data: 'colortype_intitule', name: 'colortype.intitule' },
{ data: 'energytype_intitule', name: 'energytype.intitule' },
{ data: 'gearbox_intitule', name: 'gearbox.intitule' },
{ data: 'vehicletype_intitule', name: 'vehicletype.intitule' },
{ data: 'typeofutility_intitule', name: 'typeofutility.intitule' },
{ data: 'motricitytype_intitule', name: 'motricitytype.intitule' },
{ data: 'typeofwheel_intitule', name: 'typeofwheel.intitule' },
{ data: 'rimtype_intitule', name: 'rimtype.intitule' },
{ data: 'listofcountry_intitule', name: 'listofcountry.intitule' },
{ data: 'user_name', name: 'user.name' },
{ data: 'liststatut_intitule', name: 'liststatut.intitule' },
{ data: 'typeoffer_intitule', name: 'typeoffer.intitule' },
{ data: 'budget_max_achat', name: 'budget_max_achat' },
{ data: 'budget_max_location', name: 'budget_max_location' },
{ data: 'description', name: 'description' },
{ data: 'libelle', name: 'libelle' },
{ data: 'emergencylevel_intitule', name: 'emergencylevel.intitule' },
{ data: 'date_limite_demande', name: 'date_limite_demande' },
{ data: 'satisfait', name: 'satisfait' },
{ data: 'date_satisfait', name: 'date_satisfait' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-NeedVehicle').DataTable(dtOverrideGlobals);
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