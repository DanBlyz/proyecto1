@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
	<!--begin::Card-->
	<div class="card card-custom gutter-b">
        <!-- Modal-->
        <div class="modal fade" id="modal-publicicdad" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">AGREGAR PUBLICDAD <span class="text-primary"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('Publicidad/guarda') }}" method="POST" id="formulario-permiso" enctype = "multipart/form-data">
                            @csrf
                            <input type="hidden" id="cliente_id" name="cliente_id" value="0">
                            <input type="text" id="publicidad_id" name="publicidad_id" value="0">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Descripcion
                                        <span class="text-danger">*</span></label>
                                        <input type="text"  id="descripcion" name="descripcion" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="archivo[]"
                                            id="customFile_1" onchange="showMyImage(this, 1)" />
                                        <label class="custom-file-label" for="customFile">Elegir</label>
                                    </div>
                                    {{-- <input type="file" accept="image/*" onchange="loadFile(event)"> --}}
                                    <center>
                                    <div style="width: 250px;">
                                        <img id="thumbnil_1" class="img-fluid" style="margin-top: 10px;" width="80%" />
                                    </div>
                                    </center>
                                    <br>
                                    <button type="button" class="btn btn-danger mr-2 btn-block"
                                        id="btnRimg_1" style="display:none;"
                                        onclick="mueveImagen(1)">Quitar Imagen
                                    </button>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Fecha Inicio
                                        <span class="text-danger">*</span></label>
                                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Fecha Fin
                                        <span class="text-danger">*</span></label>
                                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Cantidad de publicaciones
                                        <span class="text-danger">*</span></label>
                                        <input type="number" id="cantidad_publicaciones" name="cantidad_publicaciones" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-block btn-success">Registrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin inicio modal  --}}

        <!-- Modal-->
        <div class="modal fade" id="modal-nuevo" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">PERMISOS DEL USUARIOS <span class="text-primary"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('Cliente/guarda') }}" method="POST" id="formulario-permiso">
                            @csrf
                            <input type="hidden" id="editar-cliente" name="editar-cliente" value="0">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nombre
                                        <span class="text-danger">*</span></label>
                                        <input type="text"  id="nombre" name="nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Contacto
                                        <span class="text-danger">*</span></label>
                                        <input type="text" id="contacto" name="contacto" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Telefonos
                                        <span class="text-danger">*</span></label>
                                        <input type="text" id="telefonos" name="telefonos" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Direccion
                                        <span class="text-danger">*</span></label>
                                        <input type="text" id="direccion" name="direccion" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-block btn-success">Registrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light-dark font-weight-bold" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- fin inicio modal  --}}

		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">Listado de Cleintes
				</h3>
			</div>
			<div class="card-toolbar">
				<!--begin::Button-->
				<a onclick="nuevoCliente()" class="btn btn-primary font-weight-bolder">
					<span class="svg-icon svg-icon-md">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
							height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<circle fill="#000000" cx="9" cy="15" r="6" />
								<path
									d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
									fill="#000000" opacity="0.3" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>Nuevo Cliente</a>
				<!--end::Button-->
			</div>
		</div>
		<div class="card-body">
			{{-- <form  id="formulario-busqueda-usuarios">
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
			</form> --}}
			<!--begin: Datatable-->
			<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>CONTACTO</th>
                        <th>TELEFONOS</th>
                        <th>DIRECCION</th>
                        {{-- <th>Criaderos</th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clientes as $cli)
                    <tr>
                        <td>{{ $cli->id }}</td>
                        <td>{{ $cli->nombre }}</td>
                        <td>{{ $cli->contacto }}</td>
                        <td>{{ $cli->telefonos }}</td>
                        <td>{{ $cli->direccion }}</td>
                        {{-- <td>{{ $cli->celulares }}</td> --}}
                        <td style="width: 10%">
                            <button type="button" class='btn btn-info' onclick="publicidades('{{ $cli->id }}')"><i class="fas fa-eye"></i></button>
                            <button type="button" class='btn btn-success' onclick="publicidad('{{ $cli->id }}')"><i class="fas fa-landmark"></i></button>
                            <button type="button" class="btn btn-warning" onclick="editar('{{ $cli->id }}', '{{ $cli->nombre }}', '{{ $cli->contacto }}', '{{ $cli->telefonos }}', '{{ $cli->direccion }}')"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" onclick="eliminar('{{ $cli->id }}', '{{ $cli->nombre }}')"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <h3 class="text-danger">NO EXISTEN DATOS</h3>
                    @endforelse
                </tbody>
                <tbody>
                </tbody>
            </table>
			<!--end: Datatable-->
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
        
        $('#tabla_criaderos').DataTable({
            order: [[ 0, "desc" ]],
            // searching: false,
            // lengthChange: false,
            language: {
                url: '{{ asset('datatableEs.json') }}'
            },
        });

        function nuevoCliente(){
            $('#modal-nuevo').modal('show');
            // alert("en desarrollo :v");
        }

        function editar(id, nombre, contacto, telefonos, direccion){
            // alert(id);
            $('#editar-cliente').val(id);
            $('#nombre').val(nombre);
            $('#contacto').val(contacto);
            $('#telefonos').val(telefonos);
            $('#direccion').val(direccion);

            $('#modal-nuevo').modal('show');
        }

        function eliminar(id, nombre){
            // alert(id);
            Swal.fire({
                title: "Quieres eliminar "+nombre+" "+id,
                text: "Ya no podras recuperarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    window.location.href = "{{ url('Cliente/elimina') }}/"+id;
                    Swal.fire(
                        "Borrado!",
                        "El registro fue eliminado.",
                        "success"
                    )
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelado",
                        "La operacion fue cancelada",
                        "error"
                    )
                }
            });
        }

        function publicidad(id){
            $('#cliente_id').val(id);
            $('#modal-publicicdad').modal('show');
            // alert(id);
        }

        function showMyImage(fileInput, numero) {

            var files = fileInput.files;
            $("#btnRimg_"+numero).show();
            console.log(numero);
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
        function publicidades(id){
            window.location.href = "{{ url('Publicidad/listado')}}/"+id;
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

		// function buscaUsuario(){

		// 	let datosBusqueda = $('#formulario-busqueda-usuarios').serializeArray();

		// 	$.ajax({
		// 		url: "{{ url('User/ajaxListado') }}",
		// 		data: datosBusqueda,
		// 		type: 'POST',
		// 		success: function(data) {
		// 			$('#ajaxUser').html(data);
		// 		}
		// 	});

		// }

		// function listaFamiliar(id){
		// 	window.location.href = "{{ url('User/listaFamiliar')}}/"+id;
		// }

		// function listaSector(id){
		// 	window.location.href = "{{ url('User/listaSector')}}/"+id;
		// }
    </script>
@endsection