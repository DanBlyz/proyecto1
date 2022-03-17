{{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"> --}}
<table class="table table-bordered table-hover table-striped" id="tabla_criaderos">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DEPARTAMENTO</th>
            <th>DESCRIPTION</th>
            {{-- <th>Criaderos</th> --}}
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($sectores as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->nombre }}</td>
            <td>{{ $s->departamento }}</td>
            <td>{{ $s->descripcion }}</td>
            <td style="width: 10%">
                <button type="button" class="btn btn-success btn-block" onclick="agregaUserSector('{{ $s->id }}','{{ $s->nombre }}','{{ $s->departamento }}')"><i class="fas fa-plus"></i></button>
            </td>
        </tr>
        @empty
        <h3 class="text-danger">NO EXISTEN DATOS</h3>
        @endforelse
    </tbody>
    <tbody>
    </tbody>
</table>
{{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}
<script>
    function agregaUserSector(agregar_id, nombre, departamento){
        // alert("en desarrollo");
        $("#btn-agregar").toggle('slow');
        $("#sectores").toggle('slow');
        $("#bloque-busca-sector").toggle('slow');
        $("#bloque-sector-seleccionado").toggle('slow');
        $boton = "<div class='form-group'><label for='exampleInputPassword1'>Sector Seleccionado: </label><button type='button' class='btn btn-primary btn-block' onclick='agregaSectorOtra()'>"+nombre+" - "+departamento+"</button></div>";
        $('#bloque-sector').html($boton);
        $("#sector-agregar").val(agregar_id);
    }

    function agregaSectorOtra(){
        $("#btn-agregar").toggle('slow');
        $("#sectores").toggle('slow');
        $("#bloque-sector-seleccionado").toggle('slow');
        $("#bloque-busca-sector").toggle('slow');
        $("#nombre").val('');
    }
</script>