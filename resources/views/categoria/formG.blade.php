@extends('social.inicio')
@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    {{-- fin inicio modal  --}}
	<!--begin::Card-->
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">REGISTRATE AQUI PRIMERO
				</h3>
			</div>
		</div>
    </div>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NUEVO DE GERENTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('Categoria/guardaG') }}" method="POST" id="formulario-gerente">
                        @csrf
                        <div class="row">
							{{-- Aqui guardamos el id_gerente --}}
							<input type="hidden" name="gerente_id" id="gerente_id" value="0">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nombre
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required />
                                </div>        
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email
                                    <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Fecha Nacimiento
                                        <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required />
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Direccion
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" required />
                                </div>        
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Telefono
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" required />
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ciudad
                                    <span class="text-danger">*</span></label>
                                    {{-- <input type="text" class="form-control" id="pais" name="pais" required /> --}}
                                    <select class="form-control" id="pais" name="pais" required>
                                        <option>--Ninguna--</option>
                                        <option>La Paz</option>                                    
                                        <option>Cochabamba</option>                                        
                                        <option>Santa Cruz</option>                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password
                                        <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" required />
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
            $("#gerente_id").val(0);
            $("#name").val("");
            $("#email").val("");
            $("#fecha_nacimiento").val("");
            $("#telefono").val("");
            $("#pais").val("");
            $("#direccion").val("");
            $("#password").val("");

            $('#nuevoGerente').modal('show');
        }

        function crear(){
            // verificamos que el formulario este correcto
    		if($("#formulario-gerente")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-gerente").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-gerente")[0].reportValidity()
    		}
        }

        function edita(id, name, email, fecha_nacimiento, telefono, pais, direccion, password){
            $("#gerente_id").val(id);
            $("#name").val(name);
            $("#email").val(email);
            $("#fecha_nacimiento").val(fecha_nacimiento);
            $("#telefono").val(telefono);
            $("#pais").val(pais);
            $("#direccion").val(direccion);
            $("#password").val(password);

            $('#nuevoGerente').modal('show');
        }

        function elimina(id , name){
            // mostramos la pregunta en el alert
            Swal.fire({
                title: "Quieres eliminar "+name,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
				// si pulsa boton si
                if (result.value) {

                    window.location.href = "{{ url('Categoria/eliminaG') }}/"+id;

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