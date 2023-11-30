@extends('template_admin.index')

@section('contents')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">Produtos</h1>
    <!-- Coonsulta -->

    <div class="card">
        <div class="card-header">Produtos cadastrados</div>
        <div class="card-body">

            <div class="mb-2">
                <a href="/admin/produto/novo" class="btn btn-dark">Novo</a>
            </div>

            <table class="table table-bordered dataTable">
                <thead>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Categoria</td>
                    <td>Marca</td>
                    <td>Cor</td>
                    <td>Preço</td>
                    <td>Quantidade</td>
                    <td>Descrição</td>
                </thead>
                <tbody>
                    @foreach ($produtos as $linha)
                        <tr>
                            <td>{{ $linha['id'] }}</td>
                            <td>{{ $linha['nome'] }}</td>
                            <td>{{ $linha['id_categoria'] }}</td>
                            <td>{{ $linha['id_marca'] }}</td>
                            <td>{{ $linha['id_cor'] }}</td>
                            <td>{{ $linha['preco'] }}</td>
                            <td>{{ $linha['quantidade'] }}</td>
                            <td>
                                <?php echo $linha['descricao'];?>
                            </td>
                            <td>
                                <div class="mb-2">
                                    <a href="/admin/produto/alterar/{{ $linha['id'] }}" class="btn btn-dark">
                                        <li class="fa fa-edit"></li>
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <a href="/admin/produto/excluir/{{ $linha['id'] }}" class="btn btn-danger">
                                        <li class="fa fa-trash"></li>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

