<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadastro;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegistryController extends Controller
{
    //Validar e Realizar cadastro no DB
    public function submitregistry(Request $request){
        //validação dos campos
        $this->validate($request, [
            'codigopessoa' => 'required|numeric',
            'tipopessoa' => 'required',
            'nome' => 'required',
            'cpfcnpj' => 'required|numeric',
            'razaosocial' => 'required_if:tipopessoa,juridica',
            'endereco' => 'required',
            'numero' => 'nullable|numeric',
            'complemento' => 'nullable',
            'cep' => 'required|numeric',
            'municipio' => 'required',
            'email' => 'nullable|email',
            'telefone' => 'nullable|numeric',
            'celular' => 'nullable|numeric',
            
        ]);
        
        
        //validação dos campos de relacionamento
        if (($request->input('cliente') == false) && ($request->input('fornecedor') == false) && ($request->input('funcionario') == false)){
            //retorna a view anterior, com os dados flash da seção anterior + o aviso do erro de pelo menos 1 relacionamento ativo
            return back()->withInput()->with("relacionamento", "Em pelo menos um dos três tipos de relacionamentos o 'Sim' precisa ser selecionado");
        }
        
        
        //validar campos que não podem se repetir em nenhum registro da tabela
        $camposunicos = ['codigopessoa', 'nome', 'cpfcnpj'];
        //varrer os 3 campos da array $camposunicos em toda a tabela
        foreach ($camposunicos as $campovez){
            //realizar uma consulta sql a cada ciclo para verificar se o valor do campo do ciclo já existe em algum registro da tabela
            $versecampoexiste = DB::table('cadastros')
                ->where($campovez, '=', $request->input($campovez))
                ->count();
            //se o conteudo de 1 dos 3 campos já existir em algum registro, a variavel $versecampoexiste terá valor != 0 e retornará a sessão com um aviso para o usuário.
            if ($versecampoexiste>0){
                return back()->withInput()->with("campoexiste", "Já existe um cadastro com este $campovez");
            }
        }
        
        //Criar novo registro no DB
        $registro = new Cadastro;
        
        $registro->codigopessoa = $request->input('codigopessoa');
        $registro->tipopessoa = $request->input('tipopessoa');
        $registro->nome = $request->input('nome');
        $registro->cpfcnpj = $request->input('cpfcnpj');
        $registro->razaosocial = $request->input('razaosocial');
        $registro->endereco = $request->input('endereco');
        $registro->numero = $request->input('numero');
        $registro->complemento = $request->input('complemento');
        $registro->cep = $request->input('cep');
        $registro->municipio = $request->input('municipio');
        $registro->cidade = $request->input('cidade');
        $registro->email = $request->input('email');
        $registro->telefone = $request->input('telefone');
        $registro->celular = $request->input('celular');
        $registro->cliente = $request->input('cliente');
        $registro->fornecedor = $request->input('fornecedor');
        $registro->funcionario = $request->input('funcionario');
            
        // Salvar registro no DB
        $registro->save();
        
        
        //cria data e hora de agora
        $dataagora = Carbon::now('-3:00')->format('d/m/Y H:i:s');
        //retorna rota de cadastro com os dados flash previamente cadastrado e uma confirmação de cadastro realizado com data e hora.
        return redirect("/") ->withInput() ->with("cadastrado", "Cadastro Realizado com Sucesso - $dataagora");
    }
    
    
    
    
    public function searchregistry (Request $request){
        
        //print_r ($request->all()); testes
        
        
        
        //iniciar consulta da pesquisa
        
        
        // desconsiderar pesquisa nesses campos caso não informados
        if ($request->nome == ""){$request->nome='null';}
        if ($request->cpfcnpj == ""){$request->cpfcnpj='null';}
        
        $consulta = DB::table('cadastros')
            ->Where('nome', 'LIKE', "%$request->nome%")
            ->orwhere('tipopessoa', '=', $request->input('tipopessoa'))
            ->orWhere('cpfcnpj', 'LIKE', "%$request->cpfcnpj%")
            ->orwhere('cliente', '=', $request->input('cliente'))
            ->orwhere('fornecedor', '=', $request->input('fornecedor'))
            ->orwhere('funcionario', '=', $request->input('funcionario'))
            ->get();
        
        
        
        
        //foreach ($consulta as $consultalinha) {   testes
        //    echo '<br>';
        //    foreach ($consultalinha as $consultacoluna) {
        //        print_r($consultacoluna);
           //     echo "&nbsp;";
         //   }
        //}
        
        
        
        
        //cria data e hora de agora
        $dataagora = Carbon::now('-3:00')->format('d/m/Y H:i:s');
        
        //salvar form atual para o proximo
        $request->flash();
        
        if (count($consulta)==0){
            return view('templates.searchregistry')->with("resultadoconsulta", $consulta)->with('consultanula', "Pesquisa realizada porém nenhum cadastro encontrado - $dataagora");

        } else {
            return view('templates.searchregistry')->with("resultadoconsulta", $consulta)->with('consultapositiva', "Pesquisa realizada com sucesso - $dataagora");
        }

        
        
        
        //return redirect("/searchregistry") ->withInput();
        
        //print_r ($request->old('cpfcnpj'));  
        
        
    }
    
    
    
    public function deleteregistry (Request $request){
        //deletar pela chave primária
        Cadastro::destroy($request->input('delete'));
        
        
        //cria data e hora de agora
        $dataagora = Carbon::now('-3:00')->format('d/m/Y H:i:s');
        
        return redirect("/searchregistry") ->withInput($request->old()) ->with("deletado", "Cadastro $request->delete deletado com Sucesso - $dataagora");
    }
    
    
    
    
    
    public function editegistry(Request $request){
        
        
        
         
        // o dado advindo de "$request->input('editar')" corresponde ao campo codigopessoa PK da tabela.
        
        //query para selecionar o cadastro a ser editado
        $cadastro = Cadastro::find($request->input('editar'));
        
        //adicionar as variaveis à request para preencher o form de edição com o ->withInput
        $request->request->add(['codigopessoa' => $cadastro->codigopessoa]);
        $request->request->add(['tipopessoa' => $cadastro->tipopessoa]);
        $request->request->add(['nome' => $cadastro->nome]);
        $request->request->add(['cpfcnpj' => $cadastro->cpfcnpj]);
        $request->request->add(['razaosocial' => $cadastro->razaosocial]);
        $request->request->add(['endereco' => $cadastro->endereco]);
        $request->request->add(['numero' => $cadastro->numero]);
        $request->request->add(['complemento' => $cadastro->complemento]);
        $request->request->add(['cep' => $cadastro->cep]);
        $request->request->add(['municipio' => $cadastro->municipio]);
        $request->request->add(['cidade' => $cadastro->cidade]);
        $request->request->add(['email' => $cadastro->email]);
        $request->request->add(['telefone' => $cadastro->telefone]);
        $request->request->add(['celular' => $cadastro->celular]);
        $request->request->add(['cliente' => $cadastro->cliente]);
        $request->request->add(['fornecedor' => $cadastro->fornecedor]);
        $request->request->add(['funcionario' => $cadastro->funcionario]);
        
        //print_r($request->input()); teste
        
        
        
        // armazenar os inputs na sessão flash
        $request->flash();
                                                    //tentar editar o $request->input() para passa-lo dentro do flash();
        return view('templates.editregistry');
        
    }
    
    
    public function editegistrysave(){
        
    }
    
}
