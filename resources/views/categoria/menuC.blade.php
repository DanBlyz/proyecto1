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
        {{-- cabeceras --}}
        
        {{-- fin cabeceras --}}

        {{-- modal registra publicacion --}}
        {{-- @auth
            
            <div class="modal fade" id="modal-publicacion-articulos" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdrop" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
            
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
    
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-40 symbol-light-success mr-5">
                                            <span class="symbol-label">
                                                <img src="assets/media/svg/avatars/007-boy-2.svg"
                                                    class="h-75 align-self-end" alt="">
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Description-->
                                        <h2 class="alert-heading">{{ Auth::user()->name }}</h2>
                                        <!--end::Description-->
                                    </div>
                                </div>
                            </div>
                            {{-- <form method="POST" action="{{ route('login') }}"> --}}
                                {{-- <form method="POST" action="{{ url('Social/guarda') }}" enctype="multipart/form-data" id="formulario-publicacion">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
            
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-40 symbol-light-success mr-5">
                                                    <span class="symbol-label">
                                                        <img src="assets/media/svg/avatars/007-boy-2.svg"
                                                            class="h-75 align-self-end" alt="">
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Description-->
                                                <span class="text-muted font-weight-bold font-size-lg">{{ Auth::user()->name }}</span>
                                                <!--end::Description-->
                                            </div>
                                        </div>
                                    </div>
                                    <h3>&nbsp;</h3> --}}
                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="radio-inline">
                                                    @foreach ($categorias as $c)
                                                    <label class="radio">
                                                        <input type="radio" @if($loop->first) checked="checked" @endif
                                                        name="categoria_id" value="{{ $c->id }}" />
                                                        <span></span>
                                                        {{ $c->nombre }}
                                                    </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
            
                                    {{-- <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="publicacion" class="form-control" rows="3"
                                                    placeholder="Escribe aqui" required></textarea>
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
                                            {{-- <center>
                                                <img id="thumbnil_1" class="img-fluid" style="margin-top: 10px;" />
                                            </center>
                                            <button type="button" class="btn btn-danger mr-2 btn-block" id="btnRimg_1"
                                                style="display:none;" onclick="mueveImagen(1)">Quitar Imagen
                                            </button>
            
                                            <h3>&nbsp;</h3>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-success btn-block" onclick="guarda();">PUBLICAR</button>
                                        </div>
            
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-light-dark font-weight-bold btn-block"
                                                data-dismiss="modal">CERRAR</button>
                                        </div>
                                    </div>
                                </form>  --}}
                        {{-- </div>
                    </div>
                </div>
            </div>

        @endauth  --}}
        {{-- end modal registrar --}}
        

        <!--begin::Row-->
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
                                                    <!--begin::Symbol-->
                                                    {{-- <div class="symbol symbol-40 symbol-light-success mr-10">
                                                        <span class="symbol">
                                                            {{-- <img src="assets/media/svg/avatars/007-boy-2.svg" class="h-75 align-self-end" alt="" /> --}}
                                                            {{-- <img src="{{ url( asset("img_publicaciones/$res->logotipo")) }}" alt="Image" width="400%" height="30%">
                                                        </span>
                                                    </div>  --}}
                                                    <!--end::Symbol-->
                                                    <!--begin::Description-->
                                                    <div class="symbol symbol-40 symbol-light-success mr-10">
                                                        <h2 class="alert-heading mr-30">{{ $men->tipo }}</h2>
                                                    </div>
                                                    <!--end::Description-->
                                                    <button type="button" class="btn btn-sm btn-icon btn-success" onclick="platillo('{{ $men->id }}')">
                                                        <i class="fas fa-angle-double-right"></i>
                                                    </button>
                                                </div>
                                            <!--end::Top-->
                                            <!--begin::Form-->
                                            {{-- <form id="kt_forms_widget_2_form" class="pt-10 ql-quil ql-quil-plain"> --}}
                                                <!--begin::Editor-->
                                                {{-- <input type="text" class="form-control" placeholder="Cuentanos que estas pensando..." onclick="abre_modal()"> --}}
                                                <!--end::Editor-->
                                                {{-- <div class="border-top my-5"></div> --}}
                                                <!--end::Toolbar-->
                                            {{-- </form> --}}
                                            <!--end::Form-->
                                        </div>
                                        
                                    <!--end::Body-->
                                </div>
                            </div>    
                            @empty
                            <h3 class="text-danger">NO EXISTEN RESTAURANTES</h3>
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

                <div class="card card-custom sticky" data-sticky="true" data-margin-top="90" data-sticky-for="1023" data-sticky-class="sticky">
                        <div class="alert mb-5 p-5" role="alert">
                            <h4 class="alert-heading">PUBLICIDAD</h4>

                            
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
