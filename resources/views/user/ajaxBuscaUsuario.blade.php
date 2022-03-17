{{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"> --}}
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
        @forelse ($usuarios as $U)
        <tr>
            <td>{{ $U->id }}</td>
            <td>{{ $U->name }}</td>
            <td>{{ $U->email }}</td>
            <td>{{ $U->perfil }}</td>
            <td>{{ $U->ci }}</td>
            <td>{{ $U->celulares }}</td>
            <td style="width: 10%">
                <button type="button" class="btn btn-success btn-block" onclick="agregaUserFamiliar('{{ $U->id }}','{{ $U->name }}','{{ $U->ci }}')"><i class="fas fa-plus"></i></button>
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
    function agregaUserFamiliar(agregar_id, nombre, cedula){
        // alert("en desarrollo");
        $("#btn-agregar").toggle('slow');
        $("#personas").toggle('slow');
        $("#bloque-familiar").toggle('slow');
        $("#bloque-familiar-seleccionado").toggle('slow');
        $boton = "<div class='form-group'><label for='exampleInputPassword1'>Familiar Seleccionado: </label><button type='button' class='btn btn-primary btn-block' onclick='agregaFAmiliarOtra()'>"+nombre+" - "+cedula+"</button></div>";
        $('#bloque-pariente').html($boton);
        $("#familiar-agregar").val(agregar_id);
    }

    function agregaFAmiliarOtra(){
        $("#btn-agregar").toggle('slow');
        $("#personas").toggle('slow');
        $("#bloque-familiar-seleccionado").toggle('slow');
        $("#bloque-familiar").toggle('slow');
        $("#ci").val('');
    }
</script>