@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')

    <!-- Modal-->
    <div class="modal fade" id="nuevoPlatillo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE PLATILLO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('Categoria/guardaP') }}" method="POST" id="formulario-platillo" enctype="multipart/form-data">{{-- para enviar archivos --}}
                        @csrf
                        <div class="row">
							{{-- Aqui guardamos el id_platillo --}}
							<input type="hidden" name="platillo_id" id="platillo_id" value="0">
							<input type="hidden" name="menu_id" id="menu_id" value="{{ $menu_id }}">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nombre
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required />
                                </div>        
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tipo
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tipo" name="tipo" required />
                                </div>        
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Precio
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="precio" name="precio" required />
                                </div>        
                            </div>
                        </div>

						<div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ingredientes
                                    <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ingredientes" name="ingredientes" required />
                                </div>        
                            </div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<div class="custom-file">
									<input type="file" class="custom-file-input" name="archivo" id="customFile_1"
										onchange="showMyImage(this, 1)" required />
									<label class="custom-file-label" for="customFile">Elegir</label>
								</div>
								{{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
								<center>
									<img id="thumbnil_1" class="img-fluid" style="margin-top: 10px;" />
								</center>
								<button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_1"
									style="display:none;" onclick="mueveImagen(1)">Quitar Imagen
								</button>

								<h3>&nbsp;</h3>
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
				<h3 class="card-label">Platillos
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
                <button class="btn btn-primary font-weight-bolder" onclick="nuevo()">
                    <i class="fa fa-plus-square"></i>
                    Nuevo Platillo
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
							<th width="30%" height="35%">Logotipo</th>
							<th>Tipo</th>
							<th>ingredientes</th>
							<th>Precio</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($platillo as $pla)
							<tr>
								<td>{{ $pla->nombre }}</td>
								{{-- <td>{{ $pla->logotipo }}</td> --}}
								<td> <img src="{{ url( asset("img_publicaciones/$pla->logotipo")) }}" alt="Image" width="30%" height="30%"></td>
								<td>{{ $pla->tipo }}</td>
								<td>{{ $pla->ingredientes }}</td>
								<td>{{ $pla->precio }}</td>
								<td>
									<button type="button" class="btn btn-sm btn-icon btn-warning" onclick="edita('{{ $pla->id }}', '{{ $pla->nombre }}', '{{ $pla->logotipo }}','{{ $pla->tipo }}', '{{ $pla->ingredientes }}', '{{ $pla->precio }}')">
										<i class="flaticon2-edit"></i>
									</button>
									<button type="button" class="btn btn-sm btn-icon btn-danger" onclick="elimina('{{ $pla->id }}', '{{ $pla->nombre }}')">
										<i class="flaticon2-cross"></i>
									</button>
								</td>
							</tr>
						@empty
							<h3 class="text-danger">NO EXISTEN PLATILLOS</h3>
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

            $("#platillo_id").val(0);
            $("#name").val("");
            $("#archivo").val("");
            $("#tipo").val("");
            $("#ingredientes").val("");
            $("#precio").val("");

            $('#nuevoPlatillo').modal('show');
        }

        function crear(){
            // verificamos que el formulario este correcto
    		if($("#formulario-platillo")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-platillo").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-platillo")[0].reportValidity()
    		}
        }

        function edita(id, nombre, logotipo, tipo, ingredientes, precio){
            $("#platillo_id").val(id);
            $("#name").val(nombre);
            $("#archivo").val(logotipo);
            $("#tipo").val(tipo);
            $("#ingredientes").val(ingredientes);
            $("#precio").val(precio);

            $('#nuevoPlatillo').modal('show');
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

                    window.location.href = "{{ url('Categoria/eliminap') }}/"+id;

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

		function menu(id) {
			window.location.href = "{{ url('Categoria/menuP') }}/"+id;
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
		function showMyImage(fileInput, numero) {

		var files = fileInput.files;
		$("#btnRimg_"+numero).show();
		// console.log(numero);
		for (var i = 0; i < files.length; i++) {
			var file = files[i];
			var imageType = /image.*/;
			if (!file.type.match(imageType)) {
				continue;
			}
			var img = document.getElementById("thumbnil_"+numero);
			img.file = file;
			var reader = new FileReader();
			reader.onload = (function (aImg) {
				return function (e) {
					aImg.src = e.target.result;
				};
			})(img);
			reader.readAsDataURL(file);
		}
	}

function mueveImagen(numero){
$("#thumbnil_"+numero).attr('src', "{{ asset('assets/blanco.jpg') }}");
$("#customFile_"+numero).val('');
$("#btnRimg_1").hide();            
}
    </script>
@endsection