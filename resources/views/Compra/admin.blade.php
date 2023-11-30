@extends('template_admin.index')

@section('contents')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">Histórico de compras</h1>
    <!-- Coonsulta -->

    <div class="card">
        <div class="card-header">Lista de compras</div>
        <div class="card-body">

            <table class="table table-bordered dataTable">
                <thead>
                    <td>ID</td>
                    <td>Email</td>
                    <td>Produto</td>
                    <td>Quantidade</td>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>
                            <td>{{ $compra['id'] }}</td>
                            <td>{{ $compra['email_visitante'] }}</td>
                            <td>
                            @php
                                foreach (explode( '.', $compra['codigo_produto']) as $key => $value) {
                                    echo $value." - ";
                                    foreach ($produtos as $produto) {
                                        if ($produto["id"] == $value) {
                                            echo $produto["nome"]."<br>";
                                        }
                                    }
                                }
                            @endphp
                            </td>
                            <td>
                            @php
                                foreach (explode( '.', $compra['quantidade']) as $key => $value) {
                                    echo $value."<br>";
                                }
                            @endphp
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
