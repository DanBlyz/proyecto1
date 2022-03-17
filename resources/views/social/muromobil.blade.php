@extends('layouts.smobil')
@section('content')
@foreach ($publicaciones as $p)
<div class="col-md-12">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    GENERAL
                    {{-- <small>sub title</small> --}}
                </h3>
            </div>
        </div>
        <div class="card-body">
            <center>
                <img src="{{ asset('assets/2.png') }}" alt="" class="w-100">
            </center>
            <br />
            {{ $p->contenido }}
        </div>
    </div>
</div>
@endforeach
@stop

@section('js')
@endsection