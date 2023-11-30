<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

session_start();

class MarcaController extends Controller
{

    public function index(){

        $dados = Marca::all()->toArray(); //semelhante ao SELECT * FROM marca

        return View("Marca.index",
            [
                'marcas' => $dados
            ]
        );
    }

    public function inserir(){
        return View("Marca.formulario");
    }

    public function salvar_novo(Request $request){

        $marca = new Marca;
        $marca->nome = $request->input("nome");
        $marca->nome_fantasia = $request->input("nome_fantasia");
        $marca->situacao = $request->input("situacao");
        $marca->save();

        return redirect("/admin/marca");

    }

    public function excluir($id){

        $marca = Marca::find($id);
        $marca->delete();

        return redirect("/admin/marca");
    }

    public function alterar($id){

        $marca = Marca::find($id)->toArray();

        return View("Marca.formulario",['marca' => $marca]);
    }

    public function salvar_update(Request $request){

        $marca = Marca::find($request->input("id"));
        $marca->nome = $request->input("nome");
        $marca->nome_fantasia = $request->input("nome_fantasia");
        $marca->situacao = $request->input("situacao");

        $marca->save();

        return redirect("/admin/marca");
    }

}
