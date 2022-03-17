<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet">
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
                <button type="button" class="btn btn-info" onclick="listaSector('{{ $U->id }}')"><i class="fas fa-map-marked-alt"></i></button>
                <button type="button" class="btn btn-success" onclick="listaFamiliar('{{ $U->id }}')"><i class="fas fa-people-arrows"></i></button>
            </td>
        </tr>
        @empty
        <h3 class="text-danger">NO EXISTEN DATOS</h3>
        @endforelse
    </tbody>
    <tbody>
    </tbody>
</table>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script>
    $('#tabla_criaderos').DataTable({
        order: [[ 0, "desc" ]],
        searching: false,
        lengthChange: false,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });
</script>