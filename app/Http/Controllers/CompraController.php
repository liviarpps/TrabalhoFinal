<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Compra;

session_start();

if (!isset($_SESSION["filter_marca"])) $_SESSION["filter_marca"] = "Nenhum";

if (!isset($_SESSION["filter_categoria"])) $_SESSION["filter_categoria"] = "Nenhum";

if (!isset($_SESSION["filter_cor"])) $_SESSION["filter_cor"] = "Nenhum";

class CompraController extends Controller
{
    public function index(){

        $categorias = Categoria::all()->toArray();
        $marcas = Marca::all()->toArray();
        $cores = Cor::all()->toArray();

        $array_marca['nome'] = [''];
        $array_categoria['nome'] = [''];
        $array_cor['cor'] = [''];

        if ($_SESSION["filter_marca"] == "Nenhum") {
            foreach ($marcas as $marca) {
                array_push($array_marca['nome'], $marca['nome']);
            }
        }else{
            $array_marca['nome'] = [$_SESSION["filter_marca"]];
        }

        if ($_SESSION["filter_categoria"] == "Nenhum") {
            foreach ($categorias as $categoria) {
                array_push($array_categoria['nome'], $categoria['nome']);
            }
        }else{
            $array_categoria['nome'] = [$_SESSION["filter_categoria"]];
        }

        if ($_SESSION["filter_cor"] == "Nenhum") {
            foreach ($cores as $cor) {
                array_push($array_cor['cor'], $cor['cor']);
            }
        }else{
            $array_cor['cor'] = [$_SESSION["filter_cor"]];
        }

        if (request('search')) {
            $produtos = Produto::select("produto.id",
                                        "produto.nome",
                                        "produto.quantidade",
                                        "produto.preco",
                                        "produto.descricao",
                                        "categoria.nome AS id_categoria",
                                        "marca.nome AS id_marca",
                                        "cor.cor AS id_cor")
                            ->join("categoria", "categoria.id",
                                    "=", "produto.id_categoria")
                            ->join("marca", "marca.id",
                                    "=", "produto.id_marca")
                            ->join("cor", "cor.id",
                                    "=", "produto.id_cor")
                            ->where("produto.nome", "like", "%" . request('search') . "%")
                            ->whereIn("marca.nome", $array_marca['nome'])
                            ->whereIn("categoria.nome", $array_categoria['nome'])
                            ->whereIn("cor.cor", $array_cor['cor'])
                            ->get();
        } else {
            $produtos = Produto::select("produto.id",
                                        "produto.nome",
                                        "produto.quantidade",
                                        "produto.preco",
                                        "produto.descricao",
                                        "categoria.nome AS id_categoria",
                                        "marca.nome AS id_marca",
                                        "cor.cor AS id_cor")
                            ->join("categoria", "categoria.id",
                                    "=", "produto.id_categoria")
                            ->join("marca", "marca.id",
                                    "=", "produto.id_marca")
                            ->join("cor", "cor.id",
                                    "=", "produto.id_cor")
                            ->whereIn("marca.nome", $array_marca['nome'])
                            ->whereIn("categoria.nome", $array_categoria['nome'])
                            ->whereIn("cor.cor", $array_cor['cor'])
                            ->get();
        }

        return View("Compra.index",
            [
                'produtos' => $produtos,
                'categorias' => $categorias,
                'marcas' => $marcas,
                'cores' => $cores
            ]
        );
    }

    public function admin(){

        $dados = Compra::all()->toArray();
        $produtos = Produto::all()->toArray();

        return View("Compra.admin",
            [
                'compras' => $dados,
                'produtos' => $produtos
            ]
        );
    }

    public function filtro($filtro, $id){

        if ($filtro) {
            if ($filtro == "marca") {
                $_SESSION["filter_marca"] = $id;
                echo "marca ".$_SESSION["filter_marca"];
            }elseif ($filtro == "categoria") {
                $_SESSION["filter_categoria"] = $id;
                echo "categoria ".$_SESSION["filter_categoria"];
            }elseif ($filtro == "cor") {
                $_SESSION["filter_cor"] = $id;
                echo "cor ".$_SESSION["filter_cor"];
            }
        }

        return redirect("/");

    }

    public function adicionar($id){
        if (!isset($_SESSION["itens_carrinho"])) {
            $_SESSION["itens_carrinho"] = [];
        }

        array_push($_SESSION["itens_carrinho"], $id);

        return redirect("/");
    }

    public function remover($id){
        unset($_SESSION["itens_carrinho"][$id]);

        return redirect("/");
    }

    public function comprar($id){
        $this->adicionar($id);

        return redirect("/carrinho");
    }

    public function carrinho(){

        if (!isset($_SESSION["itens_carrinho"])) {
            $_SESSION["itens_carrinho"] = [];
        }

        if (request('search')) {
            $produtos = Produto::select("produto.id",
                                        "produto.nome",
                                        "produto.quantidade",
                                        "produto.preco",
                                        "produto.descricao",
                                        "categoria.nome AS id_categoria",
                                        "marca.nome AS id_marca",
                                        "cor.cor AS id_cor")
                                ->join("categoria", "categoria.id",
                                    "=", "produto.id_categoria")
                                ->join("marca", "marca.id",
                                    "=", "produto.id_marca")
                                ->join("cor", "cor.id",
                                    "=", "produto.id_cor")
                                ->whereIn("produto.id", $_SESSION["itens_carrinho"])
                                ->where("produto.nome", "like", "%" . request('search') . "%")
                                ->get();
        }else{
            $produtos = Produto::select("produto.id",
                                        "produto.nome",
                                        "produto.quantidade",
                                        "produto.preco",
                                        "produto.descricao",
                                        "categoria.nome AS id_categoria",
                                        "marca.nome AS id_marca",
                                        "cor.cor AS id_cor")
                                ->join("categoria", "categoria.id",
                                    "=", "produto.id_categoria")
                                ->join("marca", "marca.id",
                                    "=", "produto.id_marca")
                                ->join("cor", "cor.id",
                                    "=", "produto.id_cor")
                                ->whereIn("produto.id", $_SESSION["itens_carrinho"])
                                ->get();
        }

        return View("Compra.carrinho",
        [
            'produtos' => $produtos
        ]);
    }

    public function finalizar_compra(Request $request){
        $compra = new Compra;
        $compra->email_visitante = $request->input("email_visitante");
        $id_produtos = [];
        $qtd_produtos = [];
        foreach ($_SESSION["itens_carrinho"] as $id_produto) {
            array_push($id_produtos, $id_produto);
            array_push($qtd_produtos, $request->input("quantidade$id_produto"));
        }
        $compra->codigo_produto = implode(".", $id_produtos);
        $compra->quantidade = implode(".", $qtd_produtos);
        $compra->save();

        echo $compra;

        $_SESSION["itens_carrinho"] = NULL;

        return redirect("/");
    }

}
