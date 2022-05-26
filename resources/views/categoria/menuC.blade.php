@extends('layouts.app')
@section('metadatos')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')

<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Dashboard-->
        <h3>&nbsp;</h3>
        <div class="row" data-sticky-container="">

            {{-- lado izquierdo --}}
            
            <div class="col-md-3">

                <div class="card card-custom sticky" data-sticky="true" data-margin-top="90" data-sticky-for="1023"
                    data-sticky-class="sticky">
                    <br />
                        <div class="col-md-12">
                            <div class="alert alert-dark mb-5 p-5" role="alert">
                                <h4 class="alert-heading">AVISOS!</h4>
                                <p>Mira todo lo que tenemos para ofrecrte, variedad de resturantes para que no salgas de casa.</p>
                                <div class="border-bottom border-white opacity-20 mb-5"></div>
                                <p class="mb-0">Primero inicia secion para ver los restaurantes.</p>
                            </div>

                        </div>

                        <div class="col-md-12">

                            <h3>CATEGORIAS</h3>
                            
                        </div>
                        
                </div>
            </div>

            {{-- fin lado izquierdo --}}

            {{-- centro --}}
            <div class="col-md-6">

                {{-- crea publicacion --}}
                <div class="row" data-sticky-container>
                    @auth
                        
                        {{-- <a onclick="abre_modal()"> --}}
                        @forelse ($menu as $men)
                            <div class="col-md-12">
                                <div class="card card-custom gutter-b">
                                    <!--begin::Body-->
                                    
                                        <div class="card-body">
                                            <!--begin::Top-->
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-40 symbol-light-success mr-10">
                                                        <h2 class="alert-heading mr-30">{{ $men->tipo }}</h2>
                                                    </div>
                                                    <!--end::Description-->
                                                    <button type="button" class="btn btn-sm btn-icon btn-success" onclick="platillo('{{ $men->id }}')">
                                                        <i class="fas fa-angle-double-right"></i>
                                                    </button>
                                                </div>
                                            <!--end::Form-->
                                        </div>
                                        
                                    <!--end::Body-->
                                </div>
                            </div>    
                            @empty
                            <h3 class="text-danger">NO EXISTEN MENUS :(</h3>
                        @endforelse  
                        {{-- </a>                         --}}
                    @endauth
                </div>
                {{-- fin crea publicacion --}}
                {{-- <div id="publicacionesAjax">

                </div> --}}

            </div>

            {{-- fin centro --}}

            {{-- lado derecho --}}

            <div class="col-md-3">

                <div class="card card-custom sticky" data-sticky="" data-margin-top="90" data-sticky-for="1023" >
                        <div class="alert mb-5 p-5" role="alert">
                            <h4 class="alert-heading">Comentarios</h4>
                            <form action="{{ url('Categoria/guardaComentario') }}" method="POST" id="formulario-comentario">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="califica_id" id="califica_id" value="0">
                                    <input type="hidden" name="res_id" id="res_id" value="{{ $res_id }}">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="comenta" name="comenta" placeholder="Agrega un comentario" />
                                            <div class="input-group-append">
                                                <button id="show_password" class="btn btn-primary" type="button" onclick="guardacoment()"> <span class="fa fa-paper-plane icon"></span> </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </form>
                            @auth
                            @forelse ($califica as $cali)
                            <div class="col-md-12">
                                <div class="alert alert-dark mb-3 p-5" role="alert">
                                    {{-- <h4 class="alert-heading">{{ $cali->usuario_id }}</h4> --}}
                                    <p>{{ $cali->comenta }}</p>
                                </div>        
                            </div>
                            @empty
                            <h3 class="text-danger">NO EXISTEN COMENTARIOS</h3>
                        @endforelse  
                        {{-- </a>                         --}}
                    @endauth
                        </div>
                </div>
            </div>

               
            {{-- fin lado derecho --}}
        </div>

<!--end::Row-->

<!--end::Dashboard-->
</div>
<!--end::Container-->
</div>

@stop

@section('js')

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*$(document).ready(function() {
        console.log( "ready!" );
    });*/

    // $(function() {
    //     $("#publicacionesAjax").load("{{ url('Social/ajaxPublicaciones') }}");
    // });
    function platillo(id) {
			window.location.href = "{{ url('Categoria/platilloC') }}/"+id;
		}

    function guardacoment(){
            // verificamos que el formulario este correcto
    		if($("#formulario-comentario")[0].checkValidity()){
				// enviamos el formulario
    			$("#formulario-comentario").submit();
				// mostramos la alerta
				Swal.fire("Excelente!", "Registro Guardado!", "success");
    		}else{
				// de lo contrario mostramos los errores
				// del formulario
    			$("#formulario-comentario")[0].reportValidity()
    		}
        }

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

    function abre_modal(){
        // alert("en desarrollo :v");
        $('#modal-publicacion-articulos').modal('show');
    }

    function guarda()
    {
        if ($("#formulario-publicacion")[0].checkValidity()) {

            $("#formulario-publicacion").submit();
            Swal.fire("Excelente!", "Se guardo el patrimonio!", "success");
            $("#publicacionesAjax").load("{{ url('Social/ajaxPublicaciones') }}");
        }else{
            $("#formulario-publicacion")[0].reportValidity();
        }
    }

    function addComent(coment_id){
        // alert("en desarrollo :v");
        var coment = $('#kt_forms_widget_11_input'+coment_id).val();
        // alert(coment);
        $.ajax({
            url: "{{ url('Social/addComent') }}",
            data: {coment: coment,
                    publicacion_id: coment_id,    
            },
            type: 'GET',
            success: function(data) {
                $('#block-coments'+coment_id).html(data);
                $('#kt_forms_widget_11_input'+coment_id).val('')
            }
        });
    }

    function editComent(publicacion_id, coment_id, coment){

        Swal.fire({
            input: 'textarea',
            inputLabel: 'Edicion de Comentario',
            inputValue: coment,
            inputPlaceholder: 'Escriba un comentario...',
            confirmButtonColor: '#C0BD0D',
            confirmButtonText: 'Editar',
            showDenyButton: true,
            denyButtonText: `Eliminar`,
            inputValidator: (value) => {
                if (!value) {
                    return 'Debe escribir un Cometario!'
                }
            },
            inputAttributes: {
                'aria-label': 'Escriba un comentario'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then(resultado => {
            if (resultado.isConfirmed) {
                if (resultado.value) {
                    $.ajax({
                        url: "{{ url('Social/editComent') }}",
                        data: {coment: resultado.value,
                                publicacion_id: publicacion_id,
                                coment_id:  coment_id  
                        },
                        type: 'GET',
                        success: function(data) {
                            //console.log(data);
                            $('#block-coments'+publicacion_id).html(data);
                            //$('#kt_forms_widget_11_input'+coment_id).val('')
                        }
                    })
                    //let nombre = resultado.value;
                    //console.log("Hola, " + nombre);
                }
                Swal.fire('Saved!', '', 'success')
            } else if (resultado.isDenied) {
                $.ajax({
                    url: "{{ url('Social/deleteComent') }}",
                    data: {
                        publicacion_id: publicacion_id,
                        coment_id:  coment_id  
                    },
                    type: 'GET',
                    success: function(data) {
                        //console.log(data);
                        $('#block-coments'+publicacion_id).html(data);
                        //$('#kt_forms_widget_11_input'+coment_id).val('')
                    }
                })
                Swal.fire('Changes are not saved', '', 'info')
            }
            
        });

        /*
        (async () => {
            const { value: text } = await Swal.fire({
            input: 'textarea',
            inputLabel: 'Edicion de Comentario',
            inputValue: coment,
            inputPlaceholder: 'Escriba un comentario...',
            confirmButtonColor: '#C0BD0D',
            confirmButtonText: 'Editar',
            showDenyButton: true,
            denyButtonText: `Eliminar`,

            inputAttributes: {
              'aria-label': 'Escriba un comentario'
            },
            inputValidator: (value) => {
                if (!value) {
                    return 'Debe escribir un Cometario!'
                }
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
          })
              console.log(text)
            //if (text) {
            //    Swal.fire(text)
            //}
        })()
        */
    }

    function categoria(categoria){
        // window.location.href = "{{ url('Social/muestraCategoria')}}"
        $.ajax({
            url: "{{ url('Social/muestraCategoria') }}",
            data: {categoria: categoria,
            },
            type: 'GET',
            success: function(data) {
                $("#publicacionesAjax").html(data);
                //console.log(data);
                // $('#block-coments'+publicacion_id).html(data);
                //$('#kt_forms_widget_11_input'+coment_id).val('')
            }
        })
    }

    

</script>
@endsection
