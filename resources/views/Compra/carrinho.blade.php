@extends('template_carrinho.index')

@section('contents')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-primary">Seu carrinho</h1>
    <!-- Coonsulta -->

    <div class="card">
        <div class="card-body">

            @if (isset($_SESSION["itens_carrinho"]) && $_SESSION["itens_carrinho"] != NULL)

                @php
                    $first = False;
                @endphp

                <form action="/carrinho/finalizar_compra" method="get" id="comprar">

                @foreach ($produtos as $produto)

                <div class="row">
                    <div class="col-sm-8">
                        <div class="card" style="margin-top: 10px">
                            <h5 class="card-header">{{$produto["nome"]}}</h5>
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="card-body">
                                        <h5 class="card-title">R$ {{$produto["preco"]}}</h5>
                                        <p class="card-text">
                                            @php
                                                echo $produto["descricao"];
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <span class="badge badge-dark">{{ $produto['id_marca'] }}</span><br>
                                            <span class="badge badge-dark">{{ $produto['id_categoria'] }}</span><br>
                                            <span class="badge badge-dark">{{ $produto['id_cor'] }}</span><br>
                                        </div>
                                        <label for="exampleInputNumber">Quantidade:</label>
                                        <input min="1" max="999" type="number" name="quantidade{{ $produto['id'] }}" id="typeNumber" class="form-control" value="{{ $produto['quantidade'] }}">
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    @if ($first == False)
                        <div style="margin: 10px; width: 50px;">
                            <div class="card" style="display: inline-block; position: absolute;" >
                            <div class="card-body">
                                    <h5 class="card-title">Finalizar compra</h5>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Digite seu email:</label>
                                        <input type="email" name="email_visitante" class="form-control" aria-describedby="emailHelp" placeholder="nome@email.com...">
                                        <input type="submit" class="btn btn-primary" style="margin-top: 10px;" value="Comprar">
                                    </div>
                            </div>
                            </div>
                        </div>
                        @php
                            $first = True;
                        @endphp
                    @endif
                  </div>
                  @endforeach

                </form>

            @else

                <p>Carrinho vazio</p>

            @endif

        </div>
    </div>

@endsection

