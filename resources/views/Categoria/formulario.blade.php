@extends('template_admin.index')

@section('contents')

    @php

        $titulo = "Nova categoria";
        $endpoint = "/admin/categoria/novo";
        $input_nome = "";
        $input_situacao = "";
        $input_id = "";

        if (isset($categoria)) {
            $titulo = "Alteração da categoria";
            $endpoint = "/admin/categoria/alterar";
            $input_nome = $categoria['nome'];
            $input_situacao = $categoria['situacao'];
            $input_id = $categoria["id"];
        }

    @endphp

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">{{{$titulo}}}</h1>
    <!-- Inserir -->

    <div class="card">
        <div class="card-header">Cadastro de categoria</div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="{{$endpoint}}" method="post">
                        @CSRF

                        <input type="hidden" name="id" value="{{$input_id}}">

                        <div class="mb-2">
                            <label class="form-label">Nome da categoria</label>
                            <input type="text" class="form-control" name="nome" value="{{$input_nome}}" placeholder="mesas...">
                        </div>
                        <div class="mb-2">
                            <select class="form-control" name="situacao" value="{{$input_situacao}}">
                                @if (isset($categoria))

                                    @if ($categoria['situacao'] == 0)
                                        <option value="{{$categoria['situacao']}}" selected>Inativo</option>
                                        <option value="1">Ativo</option>
                                    @else
                                        <option value="{{$categoria['situacao']}}" selected>Ativo</option>
                                        <option value="0">Inativo</option>
                                    @endif

                                @else

                                    <option value="1" selected>Ativo</option>
                                    <option value="0">Inativo</option>

                                @endif
                            </select>
                        </div>
                        <div class="mb-2">
                            <input type="submit" class="btn btn-outline-dark" value="Salvar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
