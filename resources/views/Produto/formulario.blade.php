@extends('template_admin.index')

@section('contents')

    @php

        $titulo = "Novo produto";
        $endpoint = "/admin/produto/novo";
        $input_nome = "";
        $input_id_categoria = "";
        $input_id_marca = "";
        $input_id_cor = "";
        $input_preco = "";
        $input_quantidade = "";
        $input_descricao = "";
        $input_id = "";

        if (isset($produto)) {
            $titulo = "Alteração do produto";
            $endpoint = "/admin/produto/alterar";
            $input_nome = $produto['nome'];
            $input_id_categoria = $produto['id_categoria'];
            $input_id_marca = $produto['id_marca'];
            $input_id_cor = $produto['id_cor'];
            $input_preco = $produto['preco'];
            $input_quantidade = $produto['quantidade'];
            $input_descricao = $produto['descricao'];
            $input_id = $produto["id"];
        }

    @endphp

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">{{{$titulo}}}</h1>
    <!-- Inserir -->

    <div class="card">
        <div class="card-header">Cadastrar produto</div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="{{$endpoint}}" method="post" id="form">
                        @CSRF

                        <input type="hidden" name="id" value="{{$input_id}}">

                        <div class="mb-2">
                            <label class="form-label">Nome do produto</label>
                            <input type="text" class="form-control" name="nome" value="{{$input_nome}}" placeholder="Tv...">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Categoria</label>
                            <select class="form-control" name="id_categoria" value="{{$input_id_categoria}}">
                                @foreach ($categorias as $categoria)

                                    @if ($input_id_categoria == $categoria['id'])

                                        <option value="{{$categoria['id']}}" selected>{{$categoria['nome']}}</option>

                                    @else

                                        <option value="{{$categoria['id']}}">{{$categoria['nome']}}</option>

                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Marca</label>
                            <select class="form-control" name="id_marca" value="{{$input_id_marca}}">
                                @foreach ($marcas as $marca)

                                    @if ($input_id_marca == $marca['id'])

                                        <option value="{{$marca['id']}}" selected>{{$marca['nome']}}</option>

                                    @else

                                        <option value="{{$marca['id']}}">{{$marca['nome']}}</option>

                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Cor</label>
                            <select class="form-control" name="id_cor" value="{{$input_id_cor}}">
                                @foreach ($cores as $cor)

                                    @if ($input_id_cor == $cor['id'])

                                        <option value="{{$cor['id']}}" selected>{{$cor['cor']}}</option>

                                    @else

                                        <option value="{{$cor['id']}}">{{$cor['cor']}}</option>

                                    @endif

                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Preço</label>
                            <input type="text" class="form-control" name="preco" value="{{$input_preco}}" placeholder="7,00...">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Quantidade</label>
                            <input type="text" class="form-control" name="quantidade" value="{{$input_quantidade}}" placeholder="2...">
                        </div>

                        <div class="mb-2">
                            <!--Bootstrap classes arrange web page components into columns and rows in a grid -->

                            <textarea type="text" id="editor" class="form-control text" name="descricao" value="{{$input_descricao}}" placeholder="Até 190 caracteres." form="form">
                                @if (isset($input_descricao))
                                    {{$input_descricao}}
                                @endif
                            </textarea>

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
