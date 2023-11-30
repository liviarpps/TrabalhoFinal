<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Cor;

session_start();

class ProdutoController extends Controller
{
    public function index(){

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
                            ->get();
        }

        return View("Produto.index",
            [
                'produtos' => $produtos,
            ]
        );
    }

    public function inserir(){
        $categorias = Categoria::all()->toArray();
        $marcas = Marca::all()->toArray();
        $cores = Cor::all()->toArray();
        return View("Produto.formulario", [
            'categorias' => $categorias,
            'marcas' => $marcas,
            'cores' => $cores
        ]);
    }

    public function salvar_novo(Request $request){

        $produto = new Produto;
        $produto->id_categoria = $request->input("id_categoria");
        $produto->id_marca = $request->input("id_marca");
        $produto->id_cor = $request->input("id_cor");
        $produto->nome = $request->input("nome");
        $produto->preco = $request->input("preco");
        $produto->quantidade = $request->input("quantidade");
        $produto->descricao = $request->input("descricao");
        $produto->save();

        return redirect("/admin/produto");

    }

    public function excluir($id){

        $produto = Produto::find($id);
        $produto->delete();

        return redirect("/admin/produto");
    }

    public function alterar($id){

        $produto = Produto::find($id)->toArray();
        $categorias = Categoria::all()->toArray();
        $marcas = Marca::all()->toArray();
        $cores = Cor::all()->toArray();

        return View("Produto.formulario",[
            'produto' => $produto,
            'categorias' => $categorias,
            'marcas' => $marcas,
            'cores' => $cores
        ]);
    }

    public function salvar_update(Request $request){

        $produto = Produto::find($request->input("id"));
        $produto->id_categoria = $request->input("id_categoria");
        $produto->id_marca = $request->input("id_marca");
        $produto->id_cor = $request->input("id_cor");
        $produto->nome = $request->input("nome");
        $produto->preco = $request->input("preco");
        $produto->quantidade = $request->input("quantidade");
        $produto->descricao = $request->input("descricao");

        $produto->save();

        return redirect("/admin/produto");
    }

}
