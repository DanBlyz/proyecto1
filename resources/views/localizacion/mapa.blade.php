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
    <div class="card-header flex-wrap py-3">
        <div class="card-title">
            <h3 class="card-label">Mapa
            </h3>
        </div>
        
    </div>
    <div class="card-body">
        
        <div class="row">
          <div class="col-md-12">
            <div id="map" style="height:650px;"></div>
          </div>
          <div class="col-md-12">
            <table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>LATITUD</th>
                  <th>LONGITUD</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($localizaciones as $l)
                <tr>
                  <td>{{ $l->user->name }}</td>
                  <td>{{ $l->latitud }}</td>
                  <td>{{ $l->longitud }}</td>
                </tr>
                @empty
                <h3 class="text-danger">NO EXISTEN DATOS</h3>
                @endforelse
              </tbody>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>
<!--end::Card-->
@stop

@section('js')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDi5qf2KXyB7kq7BOO-i9bVUNaq-paBe3A"></script>
<script type="text/javascript">

var locations = [
      @forelse ($localizaciones as $l)
        ['{{ $l->user->name }}', {{ $l->latitud }}, {{ $l->longitud }}, 4],  
      @empty
        
      @endforelse      
    ];
    
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      center: new google.maps.LatLng(-16.710007529850046, -66.5542904284719),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    var infowindow = new google.maps.InfoWindow();

    var marker, i;
    
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });
      
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }






</script>
@endsection