@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    <!-- Modal-->
    <div class="modal fade" id="nuevoCategoiria" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE CATEGORIA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('Categoria/guarda') }}" method="POST" id="formulario-categoria">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nombre
                                    <span class="text-danger">*</span></label>
                                    <input type="hidden" id="categoria_id" name="categoria_id" value="0" />
                                    <input type="text" class="form-control" id="nombre" name="nombre" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Descipcion
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" required />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-sm btn-light-dark font-weight-bold " data-dismiss="modal">Cerrar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-sm btn-success font-weight-bold"  onclick="crear()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- fin inicio modal  --}}
	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">Categorias
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
                <button class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                    <i class="fa fa-plus-square"></i>
                    Nueva Categoria
                </button>
				<!--end::Button-->
			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40">
				<table class="table table-bordered table-hover table-striped" id="tabla-insumos">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Direccion</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($categorias as $cat)
							<tr>
								<td>{{ $cat->nombre }}</td>
								<td>{{ $cat->descripcion }}</td>
								<td>
									<button type="button" class="btn btn-sm btn-icon btn-warning" onclick="edita('{{ $cat->id }}', '{{ $cat->nombre }}', '{{ $cat->descripcion }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-sm btn-icon btn-danger" onclick="elimina('{{ $cat->id }}', '{{ $cat->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN CATEGORIAS</h3>
						@endforelse
					</tbody>
					<tbody>
					</tbody>
				</table>
			</div>
			<!--end: Datatable-->
		</div>
		{{-- <div class="card-body">
			<form  id="formulario-busqueda-usuarios">
				@csrf
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleInputPassword1">NOMBRE</label>
							<input type="text" class="form-control" id="nombre" name="nombre" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="exampleInputPassword1">CARNET</label>
							<input type="text" class="form-control" id="ci" name="ci" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="exampleInputPassword1">EMAIL</label>
							<input type="text" class="form-control" id="email" name="email" />
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label for="exampleInputPassword1">PERFIL</label>
							<input type="text" class="form-control" id="perfil" name="perfil" />
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<p style="margin-top: 24px;"></p>
							<button class="btn btn-success btn-block" type="button" onclick="buscaUsuario()" ><i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</form>
			<!--begin: Datatable-->
			<div class="table-responsive m-t-40" id="ajaxUser">

			</div>
			<!--end: Datatable-->
		</div> --}}
	</div>
									<!--end::Card-->
@stop

@section('js')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/basic.js') }}"></script>
    <script type="text/javascript">
		//Llamamamos a lista de ajax
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        function nuevo(){
            $("#categoria_id").val(0);
            $("#nombre").val("");
            $("#descripcion").val("");

            $('#nuevoCategoiria').modal('show');
        }

        function crear(){
            // verificamos que el formulario este correcto
    		if($("#formulario-categoria")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-categoria").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-categoria")[0].reportValidity()
    		}
        }

        function edita(id, nombre, descripcion){
            $("#categoria_id").val(id);
            $("#nombre").val(nombre);
            $("#descripcion").val(descripcion);

            $('#nuevoCategoiria').modal('show');
        }

        function elimina(id , nombre){
            // mostramos la pregunta en el alert
            Swal.fire({
                title: "Quieres eliminar "+nombre,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
				// si pulsa boton si
                if (result.value) {

                    window.location.href = "{{ url('Categoria/elimina') }}/"+id;

                    Swal.fire(
                        "Borrado!",
                        "El registro fue eliminado.",
                        "success"
                    )
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });
        }

		// $(function () {
		// 	// funcion para llamar a los datos iniciales de la tabla
		// 	let datosBusquda = $('#formulario-busqueda-usuarios').serializeArray();

		// 	$.ajax({
		// 		url: "{{ url('User/ajaxListado') }}",
		// 		data: datosBusquda,
		// 		type: 'POST',
		// 		success: function(data) {
		// 			$('#ajaxUser').html(data);
		// 		}
		// 	});
    	// });

		function buscaUsuario(){

			let datosBusqueda = $('#formulario-busqueda-usuarios').serializeArray();

			$.ajax({
				url: "{{ url('User/ajaxListado') }}",
				data: datosBusqueda,
				type: 'POST',
				success: function(data) {
					$('#ajaxUser').html(data);
				}
			});

		}

		function listaFamiliar(id){
			window.location.href = "{{ url('User/listaFamiliar')}}/"+id;
		}

		function listaSector(id){
			window.location.href = "{{ url('User/listaSector')}}/"+id;
		}
    	// $(document).ready(function() {
    	//     $('#tabla_usuarios').DataTable({
		// 		iDisplayLength: 10,
		// 		processing: true,
		// 		browser: false,
		// 		serverSide: true,
		// 		ajax: "{{ url('User/ajax_listado') }}",
		// 		"order": [[ 0, "desc" ]],
		// 		columns: [
		// 			{data: 'id', name: 'id'},
		// 			{data: 'name', name: 'name'},
		// 			{data: 'ci', name: 'ci'},
		// 			{data: 'email', name: 'email'},
		// 			{data: 'perfil', name: 'perfil'},
		// 			{data: 'celulares', name: 'celulares'},
		// 			{data: 'action'},
		// 		],
        //         language: {
        //             url: '{{ asset('datatableEs.json') }}'
        //         }
        //     });
    	// } );

    	// function edita(id)
    	// {
    	// 	window.location.href = "{{ url('User/edita') }}/"+id;
    	// }
    </script>
@endsection