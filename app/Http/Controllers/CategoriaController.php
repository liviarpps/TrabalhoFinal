<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

session_start();

class CategoriaController extends Controller
{

    public function index(){

        $dados = Categoria::all()->toArray();

        return View("Categoria.index",
            [
                'categorias' => $dados
            ]
        );
    }

    public function inserir(){
        return View("Categoria.formulario");
    }

    public function salvar_novo(Request $request){

        $categoria = new categoria;
        $categoria->nome = $request->input("nome");
        $categoria->situacao = $request->input("situacao");

        $categoria->save();

        return redirect("/admin/categoria");

    }

    public function excluir($id){
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect("/admin/categoria");
    }

    public function alterar($id){

        $categoria = Categoria::find($id)->toArray();

        return View("Categoria.formulario",['categoria' => $categoria]);
    }

    public function salvar_update(Request $request){

        $categoria = Categoria::find($request->input("id"));
        $categoria->nome = $request->input("nome");
        $categoria->situacao = $request->input("situacao");

        $categoria->save();

        return redirect("/admin/categoria");
    }
}
