@extends('template_admin.index')

@section('contents')

    @php

        $titulo = "Nova cor";
        $endpoint = "/admin/cor/novo";
        $input_cor = "";
        $input_situacao = "";
        $input_id = "";

        if (isset($cor)) {
            $titulo = "Alteração da cor";
            $endpoint = "/admin/cor/alterar";
            $input_cor = $cor['cor'];
            $input_situacao = $cor['situacao'];
            $input_id = $cor["id"];
        }

    @endphp

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">{{{$titulo}}}</h1>
    <!-- Inserir -->

    <div class="card">
        <div class="card-header">Cadastro de cor</div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="{{$endpoint}}" method="post">
                        @CSRF

                        <input type="hidden" name="id" value="{{$input_id}}">

                        <div class="mb-2">
                            <label class="form-label">Nome da cor</label>
                            <input type="text" class="form-control" name="cor" value="{{$input_cor}}" placeholder="Vermeio...">
                        </div>
                        <div class="mb-2">
                            <select class="form-control" name="situacao" value="{{$input_situacao}}">
                                @if (isset($cor))

                                    @if ($cor['situacao'] == 0)
                                        <option value="{{$cor['situacao']}}" selected>Inativo</option>
                                        <option value="1">Ativo</option>
                                    @else
                                        <option value="{{$cor['situacao']}}" selected>Ativo</option>
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
