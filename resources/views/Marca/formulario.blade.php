@extends('template_admin.index')

@section('contents')

    @php

        $titulo = "Nova marca";
        $endpoint = "/admin/marca/novo";
        $input_nome = "";
        $input_fantasia = "";
        $input_situacao = "";
        $input_id = "";

        if (isset($marca)) {
            $titulo = "Alteração da marca";
            $endpoint = "/admin/marca/alterar";
            $input_nome = $marca['nome'];
            $input_fantasia = $marca['nome_fantasia'];
            $input_situacao = $marca['situacao'];
            $input_id = $marca["id"];
        }

    @endphp

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">{{{$titulo}}}</h1>
    <!-- Inserir -->

    <div class="card">
        <div class="card-header">Cadastro de marca</div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="{{$endpoint}}" method="post">
                        @CSRF

                        <input type="hidden" name="id" value="{{$input_id}}">

                        <div class="mb-2">
                            <label class="form-label">Nome da marca</label>
                            <input type="text" class="form-control" name="nome" value="{{$input_nome}}" placeholder="Redragon...">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Nome fantasia</label>
                            <input type="text" class="form-control" name="nome_fantasia" value="{{$input_fantasia}}" placeholder="fantasia...">
                        </div>
                        <div class="mb-2">
                            <select class="form-control" name="situacao" value="{{$input_situacao}}">
                                @if (isset($marca))

                                    @if ($marca['situacao'] == 0)
                                        <option value="{{$marca['situacao']}}" selected>Inativo</option>
                                        <option value="1">Ativo</option>
                                    @else
                                        <option value="{{$marca['situacao']}}" selected>Ativo</option>
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
