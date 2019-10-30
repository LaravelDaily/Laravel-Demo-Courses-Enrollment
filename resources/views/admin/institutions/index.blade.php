@extends('layouts.admin')
@section('content')
@can('institution_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.institutions.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.institution.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.institution.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Institution">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.institution.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.institution.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.institution.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.institution.fields.logo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($institutions as $key => $institution)
                        <tr data-entry-id="{{ $institution->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $institution->id ?? '' }}
                            </td>
                            <td>
                                {{ $institution->name ?? '' }}
                            </td>
                            <td>
                                {{ $institution->description ?? '' }}
                            </td>
                            <td>
                                @if($institution->logo)
                                    <a href="{{ $institution->logo->getUrl() }}" target="_blank">
                                        <img src="{{ $institution->logo->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('institution_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.institutions.show', $institution->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('institution_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.institutions.edit', $institution->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('institution_delete')
                                    <form action="{{ route('admin.institutions.destroy', $institution->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('institution_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.institutions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Institution:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection