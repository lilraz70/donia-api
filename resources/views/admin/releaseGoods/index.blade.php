@extends('layouts.admin')
@section('content')
@can('release_good_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.release-goods.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.releaseGood.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'ReleaseGood', 'route' => 'admin.release-goods.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.releaseGood.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-ReleaseGood">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.date_sorti_prevu') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.conditions_bailleur') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.commentaires') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.nb_chambre') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.localisation') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.geolocalisation') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.date_limite') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.contact_bailleur') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.accord_bailleur') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.propertytype') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.setcountry') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.city') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.quartier') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.liststatut') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.emergencylevel') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.libelle') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.verif_accord_bailleur') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.cout') }}
                    </th>
                    <th>
                        {{ trans('cruds.releaseGood.fields.loyer_augmentera') }}
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
                            @foreach($property_types as $key => $item)
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
                            @foreach($emergency_levels as $key => $item)
                                <option value="{{ $item->intitule }}">{{ $item->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\ReleaseGood::VERIF_ACCORD_BAILLEUR_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\ReleaseGood::LOYER_AUGMENTERA_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
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
@can('release_good_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.release-goods.massDestroy') }}",
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
    ajax: "{{ route('admin.release-goods.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'date_sorti_prevu', name: 'date_sorti_prevu' },
{ data: 'conditions_bailleur', name: 'conditions_bailleur' },
{ data: 'commentaires', name: 'commentaires' },
{ data: 'nb_chambre', name: 'nb_chambre' },
{ data: 'localisation', name: 'localisation' },
{ data: 'geolocalisation', name: 'geolocalisation' },
{ data: 'date_limite', name: 'date_limite' },
{ data: 'contact_bailleur', name: 'contact_bailleur' },
{ data: 'accord_bailleur', name: 'accord_bailleur' },
{ data: 'propertytype_intitule', name: 'propertytype.intitule' },
{ data: 'setcountry_intitule', name: 'setcountry.intitule' },
{ data: 'city_intitule', name: 'city.intitule' },
{ data: 'quartier_intitule', name: 'quartier.intitule' },
{ data: 'user_name', name: 'user.name' },
{ data: 'liststatut_intitule', name: 'liststatut.intitule' },
{ data: 'emergencylevel_intitule', name: 'emergencylevel.intitule' },
{ data: 'libelle', name: 'libelle' },
{ data: 'verif_accord_bailleur', name: 'verif_accord_bailleur' },
{ data: 'cout', name: 'cout' },
{ data: 'loyer_augmentera', name: 'loyer_augmentera' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-ReleaseGood').DataTable(dtOverrideGlobals);
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