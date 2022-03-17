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
    <div class="modal fade" id="modal-agrega-sector" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Resgistro de Sector</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('User/agregaSector') }}" method="POST" id="formularioDistritos">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <div class="row" id="bloque-busca-sector">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Buscar por Nombre
                                        <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"/>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="bloque-sector-seleccionado" style="display: none;" >
                            <div class="col-md-12" id="bloque-sector">

                            </div>
                            <input type="hidden" id="sector-agregar" name="sector-agregar">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Relacion Familiar
                                        <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Hijo, Primo, Tio,etc" id="relacion" name="relacion" required />
                                </div>
                            </div> --}}
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12" id="sectores">

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
				<h3 class="card-label">Lista de Sectores del Usuario<span class="text-primary"> ( {{ strtoupper($user->name) }} )</span>
				</h3>
			</div>
			<div class="card-toolbar">
                <button type="button" onclick="agregarSEctor()" class="btn btn-primary btn-block">Nuevo Familiar</button>
			</div>
		</div>
		<div class="card-body">
			<!--begin: Datatable-->
			<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SECTOR</th>
                        <th>DEPARTAMENTO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($encargados as $e)
                    <tr>
                        <td>{{ $e->sector->id }}</td>
                        <td>{{ $e->sector->nombre }}</td>
                        <td>{{ $e->sector->departamento }}</td>
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

        function agregarSEctor(){
            $('#modal-agrega-sector').modal('show');
        }

        $("#nombre").on("change paste keyup", function() {

            let nombre = $("#nombre").val();

            $.ajax({
                url: "{{ url('User/ajaxBuscaSector') }}",
                data: {
                    nombre: nombre
                },
                type: 'POST',
                success: function(data) {
                    $("#sectores").html(data);
                }
            });

        });

    </script>
@endsection