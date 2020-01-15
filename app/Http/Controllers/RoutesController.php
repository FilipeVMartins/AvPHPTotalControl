<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutesController extends Controller
{
    //
    
    
    
    public function getRegistry () {
        return view('templates.home');//inicio = home = cadastro
    }
    
    public function getSearchregistry () {
        return view('templates.searchregistry');//para retornar a view com as mensagens de confirmação
    }
    
    public function getDeleteregistry () {
        return redirect("/searchregistry");//para redirecionar para a rota searchregistry caso tente-se acessar deleteregistry via get
    }
    
    public function getEditregistry(Request $request) {     
        return view('templates.editregistry'); //para retornar a view editregistry com as mensagens de erro da validação,
    }
    
    public function getSave(Request $request) {
        if ($request->codigopessoa==''){
            return redirect("/searchregistry");//para redirecionar para a rota searchregistry caso tente-se acessar save sem que nenhum codigopessoa tenha sido selecionado
        } else {//???????????????
            return view('templates.editregistry'); //para retornar a view com as mensagens de erro da validação
        }
    }
	
	public function getSubmitregistry () {
		return redirect("/");
	}
    
    
}
