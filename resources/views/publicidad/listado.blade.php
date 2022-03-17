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
                        <h5 class="modal-title" id="exampleModalLabel">FORMULARIO DE PUBLICIDAD<span class="text-primary"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('Publicidad/guarda') }}" method="POST" id="formulario-permiso" enctype = "multipart/form-data">
                            @csrf
                            <input type="text" id="publicidad_id" name="publicidad_id" value="0">
                            <input type="text" id="cliente_id" name="cliente_id" value="{{ $cliente->id }}">
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

		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">Listado de Publiciades del CLiente de <span class="text-primary"> <b> {{ $cliente->nombre }}</b></span>
				</h3>
			</div>
			<div class="card-toolbar">
				{{-- <!--begin::Button-->
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
				<!--end::Button--> --}}
			</div>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DESCRIPCION</th>
                        <th>FECHA DE INICIO</th>
                        <th>FECHA FIN</th>
                        <th>CANTIDAD DE PUBLICACIONES</th>
                        <th>IMAGEN</th>
                        {{-- <th>Criaderos</th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($publicidades as $pu)
                    <tr>
                        <td>{{ $pu->id }}</td>
                        <td>{{ $pu->descripcion }}</td>
                        <td>{{ $pu->fecha_inicio }}</td>
                        <td>{{ $pu->fecha_fin }}</td>
                        <td>{{ $pu->cantidad_publicaciones }}</td>
                        <td>
                            {{-- {{ $pu->banner }} --}}
                            <img src="{{ asset('img_publicidad')."/".$pu->banner }}" width="100px" alt="aqui la imagen">
                        </td>
                        <td>
                            <button type="button" onclick="edit('{{ $pu->id }}','{{ $pu->descripcion }}','{{ $pu->fecha_inicio }}','{{ $pu->fecha_fin }}','{{ $pu->cantidad_publicaciones }}','{{ $pu->banner }}')" class="btn btn-warning"><i class="fa fa-edit"></i></button>
                            <button type="button" onclick="delet('{{ $pu->id }}','{{ $pu->descripcion }}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
            console.log(numero+"show");
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

        function edit(id, descripcion, fecha_inicio, fecha_fin, cantidad_publicaciones, banner){
            $('#publicidad_id').val(id);
            $('#descripcion').val(descripcion);
            $('#fecha_inicio').val(fecha_inicio);
            $('#fecha_fin').val(fecha_fin);
            $('#cantidad_publicaciones').val(cantidad_publicaciones);

            src = "{{ asset('img_publicidad')}}"+"/"+banner,

            $("#thumbnil_1").attr("src",src);

            $('#modal-publicicdad').modal('show');

            // window.location.href = "{{ url('Publicidad/editPublicidad')}}/"+id;
            // alert(id);
        }

        function delet(id, nombre){
            Swal.fire({
                title: 'Esta seguro de elimnar '+nombre+'?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                '¡Eliminado!',
                'Su archivo ha sido eliminado.',
                'success'
                )
                window.location.href = "{{ url('Publicidad/delet')}}/"+id;
            }
            })
        }
		
    </script>
@endsection