@forelse ($restaurantes as $res)
<div class="col-md-12">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-40 symbol-light-success mr-10">
                    <span class="symbol">
                        <img src="{{ url( asset("img_publicaciones/$res->logotipo")) }}" alt="Image" width="400%" height="30%">
                    </span>
                </div>
                <div class="alert-heading mr-30 pt-0">
                    <h2>{{ $res->nombre }}</h2>
                    <p>Atencion de {{ $res->hora_apertura }} a {{ $res->hora_cierre }}<br> 
                    <a href="{{ $res->ubicacion }}">Ubicacion</a></p>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-sm btn-icon btn-success" onclick="menu('{{ $res->id }}')">
                            <i class="fas fa-angle-double-right"></i>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-sm btn-icon btn-success" onclick="addLike('{{ $res->id }}')"><i class="fa fa-trash"></i></button>
                    </div>
                    <div class="col-md-4">
                        @php
                            $likes = App\like::where('restaurant_id',$res->id)->count();
                        @endphp
                        <span class="text-success" id="numlikes{{ $res->id }}">{{ $likes }}</span>
                        <span class="text-success">LIKES</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@empty
<h3 class="text-danger">NO EXISTEN RESTAURANTES</h3>
@endforelse 