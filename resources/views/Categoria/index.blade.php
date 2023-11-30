@extends('template_admin.index')

@section('contents')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">Categorias de produtos</h1>
    <!-- Coonsulta -->

    <div class="card">
        <div class="card-header">Categorias cadastradas</div>
        <div class="card-body">

            <div class="mb-2">
                <a href="/admin/categoria/novo" class="btn btn-dark">Novo</a>
            </div>

            <table class="table table-bordered dataTable">
                <thead>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Opções</td>
                </thead>
                <tbody>
                    @foreach ($categorias as $linha)
                        <tr>
                            <td>{{ $linha['id'] }}</td>
                            <td>{{ $linha['nome'] }}</td>
                            <td>
                                <a href="/admin/categoria/alterar/{{ $linha['id'] }}" class="btn btn-dark">
                                    <li class="fa fa-edit"></li>
                                </a>
                                <a href="/admin/categoria/excluir/{{ $linha['id'] }}" class="btn btn-danger">
                                    <li class="fa fa-trash"></li>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
