@extends('layouts.app')

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">FORMULARIO DE REGISTRO</h3>
                
            </div>
            <!--begin::Form-->
            <form action="{{ url('User/guardaRegistro') }}" method="POST" id="formularioPersona">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nombre
                                <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required />
                            </div>        
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Carnet
                                <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="ci" name="ci" required />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email
                                <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" onfocusout="validaEmail()" required />
                                <span class="form-text text-danger" id="msg-error-email" style="display: none;">Correo duplicado, cambielo!!!</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password
                                    <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password" required />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Fecha Nacimiento
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Direccion
                                <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="direccion" name="direccion" required />
                            </div>        
                        </div>
                        
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Telefonos
                                <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="celulares" name="celulares" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div id="map" style="height:650px; width:100%;"></div>                
                        <input type="hidden" class="form-control" id="lat1">
                        <input type="hidden" class="form-control" id="lng1">
                    </div>
                    <br />

                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary mr-2 btn-block" onclick="guarda()">Guardar</button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('User/listado') }}" class="btn btn-secondary btn-block">Volver</a>
                        </div>
                    </div>

                </div>
                
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
    
</div>

@stop

@section('js')
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi5qf2KXyB7kq7BOO-i9bVUNaq-paBe3A&callback=initMap&v=weekly" async></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi5qf2KXyB7kq7BOO-i9bVUNaq-paBe3A" async></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?"></script> --}}
    <script type="text/javascript">

    // let map;
        $.ajaxSetup({
            // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function guarda()
        {
            if ($("#formularioPersona")[0].checkValidity()) {

                $("#formularioPersona").submit();
                Swal.fire("Excelente!", "Se guardo el distrito!", "success");

            }else{
                $("#formularioPersona")[0].reportValidity();
            }
        }

        $(function() {

            // let
            // console.log( "ready!" );
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
            }
            else
            {
                alert('Por favor habilite la ubicacion.');
            }
        });

        function successFunction(position) 
        {
            var lat = position.coords.latitude;
            var long = position.coords.longitude;
            $("#lat1").val(lat);
            $("#lng1").val(long);
            muestraMapa(lat, long);
            // alert('Your latitude is :'+lat+' and longitude is '+long);
        }

        function errorFunction(position) 
        {
            alert('Error!');
        }

        function muestraMapa(lat, long)
        {
            var myLatlng = new google.maps.LatLng(lat, long);

            // creamos el mapa
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: new google.maps.LatLng(lat, long),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            // ponemos el marcador que se pueda mover
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, long),
                draggable: true
            });
            // adicionamos el escuchador del evento
            // capturamos las coordenadas 
            // llenamos los dats en el formulario
            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#lat1").val(evt.latLng.lat().toFixed(6));
                $("#lng1").val(evt.latLng.lng().toFixed(6));
                map.panTo(evt.latLng);
            });
            // centramos la posicion del mapa
            map.setCenter(vMarker.position);
            // adicionamos el marcador en el mapa
            vMarker.setMap(map);

        }

        function validaEmail()
        {
            let email = $("#email").val();

            $.ajax({
                url: "{{ url('User/validaEmail') }}",
                data: {email: email},
                type: 'POST',
                success: function(data) {
                    // console.log(data.vEmail);     
                    if(data.vEmail > 0){
                        $("#msg-error-email").show();
                    }else{
                        $("#msg-error-email").hide();
                    }
                }
            });
        }

    </script>
@endsection
