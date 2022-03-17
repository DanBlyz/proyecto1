@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection
@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
	<!--begin::Card-->
    {{-- modal formulario --}}
    <div class="modal fade" id="modal-agrega-familiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Resgistro de Familiares</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('User/agregaFamiliar') }}" method="POST" id="formularioDistritos">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <div class="row" id="bloque-familiar">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Cedula de Identidad
                                        <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ci" name="ci"/>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="bloque-familiar-seleccionado" style="display: none;" >
                            <div class="col-md-6" id="bloque-pariente">

                            </div>
                            <input type="hidden" id="familiar-agregar" name="familiar-agregar">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Relacion Familiar
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Hijo, Primo, Tio,etc" id="relacion" name="relacion" required />
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12" id="personas">

                            </div>
                            <div class="col-md-12" id="btn-agregar" style="display: none;">
                                <button class="btn btn-success btn-block">AGREGAR</button>
                            </div>
                            {{-- <div class="col-md-6">
                                <button type="button" class="btn btn-success mr-2 btn-block" onclick="guarda();">Guardar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="reset" class="btn btn-secondary btn-block" data-dismiss="modal">Cancelar</button>
                            </div> --}}
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>
    {{-- fin modal formulario --}}
	<div class="card card-custom gutter-b">
		<div class="card-header flex-wrap py-3">
			<div class="card-title">
				<h3 class="card-label">Lista de Parientes <span class="text-primary"> ( {{ strtoupper($user->name) }} )</span>
				</h3>
			</div>
			<div class="card-toolbar">
                <button type="button" onclick="agregaFAmiliar()" class="btn btn-primary btn-block">Nuevo Familiar</button>
			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>PERFIL</th>
                        <th>CEDULA</th>
                        <th>CELULARES</th>
                        {{-- <th>Criaderos</th> --}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($parientes as $p)
                    <tr>
                        <td>{{ $p->pariente->id }}</td>
                        <td>{{ $p->pariente->name }}</td>
                        <td>{{ $p->pariente->email }}</td>
                        <td>{{ $p->pariente->perfil }}</td>
                        <td>{{ $p->pariente->ci }}</td>
                        <td>{{ $p->pariente->celulares }}</td>
                        <td style="width: 10%">
                            {{-- <button type="button" class="btn btn-success" onclick="agregaFAmiliar('{{ $p->id }}')"><i class="fas fa-people-arrows"></i></button> --}}
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

        $('#tabla_criaderos').DataTable({
            order: [[ 0, "desc" ]],
            searching: true,
            lengthChange: true,
            language: {
                url: '{{ asset('datatableEs.json') }}'
            },
        });

		//Llamamamos a lista de ajax
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        function agregaFAmiliar(){
            $('#modal-agrega-familiar').modal('show');
        }

        $("#ci").on("change paste keyup", function() {

            let ci = $("#ci").val();

            $.ajax({
                url: "{{ url('User/ajaxBuscaUsuario') }}",
                data: {
                    ci: ci
                },
                type: 'POST',
                success: function(data) {
                    $("#personas").html(data);
                }
            });

        });

        function agregaFAmiliarOtra(){
            alert('en desarrollo :v');
            // $("#ci").val('');
            // $('#modal-agrega-familiar').modal('show');
        }

        // function agregaUserFamiliar(agregar_id){
        //     // alert("en desarrollo");
        //     $("#btn-agregar").toggle('slow');
        //     $("#personas").toggle('slow');

        // }

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
    </script>
@endsection