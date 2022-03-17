@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">Mapa
            </h3>
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('assets/mapa.png') }}">
            </div>
        </div>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/datatables/basic/basic.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
    	    $('#tabla_usuarios').DataTable({
				iDisplayLength: 10,
				processing: true,
				serverSide: true,
				ajax: "{{ url('User/ajax_listado') }}",
				"order": [[ 0, "desc" ]],
				columns: [
					{data: 'id', name: 'id'},
					{data: 'name', name: 'name'},
					{data: 'ci', name: 'ci'},
					{data: 'email', name: 'email'},
					{data: 'perfil', name: 'perfil'},
					{data: 'celulares', name: 'celulares'},
					{data: 'action'},
				],
                language: {
                    url: '{{ asset('datatableEs.json') }}'
                }
            });
    	} );

    	function edita(id)
    	{
    		window.location.href = "{{ url('User/edita') }}/"+id;
    	}
</script>
@endsection