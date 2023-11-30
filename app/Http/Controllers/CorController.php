<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cor;

session_start();

class CorController extends Controller
{

    public function index(){

        $dados = Cor::all()->toArray();

        return View("Cor.index",
            [
                'cores' => $dados
            ]
        );
    }

    public function inserir(){
        return View("Cor.formulario");
    }

    public function salvar_novo(Request $request){

        $cor = new cor;
        $cor->cor = $request->input("cor");
        $cor->situacao = $request->input("situacao");

        $cor->save();

        return redirect("/admin/cor");

    }

    public function excluir($id){
        $cor = Cor::find($id);
        $cor->delete();

        return redirect("/admin/cor");
    }

    public function alterar($id){
        $cor = Cor::find($id)->toArray();

        return View("Cor.formulario",['cor' => $cor]);

    }

    public function salvar_update(Request $request){

        $cor = Cor::find($request->input("id"));
        $cor->cor = $request->input("cor");
        $cor->situacao = $request->input("situacao");

        $cor->save();

        return redirect("/admin/cor");
    }
}
