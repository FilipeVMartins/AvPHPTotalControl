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
            'codigopessoa' => 'required|numeric|max:999999999999999',
            'tipopessoa' => 'required|max:8|in:juridica,fisica',
            'nome' => 'required|max:120',
            'cpfcnpj' => 'required|numeric|max:99999999999999',
            'razaosocial' => 'required_if:tipopessoa,juridica|max:120',
            'endereco' => 'required|max:120',
            'numero' => 'nullable|numeric|max:170000',
            'complemento' => 'nullable|max:20',
            'cep' => 'required|numeric|max:99999999',
            'municipio' => 'required|max:100',
            'cidade' => 'required|max:100',
            'email' => 'nullable|email|max:100',
            'telefone' => 'nullable|numeric|max:999999999999999',
            'celular' => 'nullable|numeric|max:999999999999999',
            'cliente' => 'nullable|numeric|max:1',
            'fornecedor' => 'nullable|numeric|max:1',
            'funcionario' => 'nullable|numeric|max:1',
            
        ]);
        
        
        //validação dos campos de relacionamento, pelo menos 1 precisa ser sim
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
        
        //iniciar consulta da pesquisa
        
        
        //validações das entradas do search
        $this->validate($request, [
            'tipopessoa' => 'nullable|max:8|in:juridica,fisica',
            'nome' => 'nullable|max:120',
            'cpfcnpj' => 'nullable|numeric|max:99999999999999',
            'cliente' => 'nullable|numeric|max:1',
            'fornecedor' => 'nullable|numeric|max:1',
            'funcionario' => 'nullable|numeric|max:1',
            'tipopesquisa' => 'required|boolean|numeric|max:1',
        ]);
        
        

        $stringwhereRaw='1 and ';// testar isso dps, adicionei para evitar erro com consulta vazia, mas vai puxar select *
        switch ($request->input('tipopesquisa')) {
            case "0":
                //$consulta = DB::table('cadastros')
                //    ->Where('nome', 'LIKE', "%$request->nome%")
                //    ->orwhere('tipopessoa', '=', $request->input('tipopessoa'))
                //    ->orWhere('cpfcnpj', 'LIKE', "%$request->cpfcnpj%")
                //    ->orwhere('cliente', '=', $request->input('cliente'))
                //    ->orwhere('fornecedor', '=', $request->input('fornecedor'))
                //    ->orwhere('funcionario', '=', $request->input('funcionario'))
                //    ->get();            ######################### Não usado ########################
                
                
                //construir string da query de pesquisa abrangente
                // os if's irão desconsiderar pesquisa nesses campos caso não informados
                if ($request->input('nome')!=''){
                    $stringwhereRaw = $stringwhereRaw . "nome LIKE '%$request->nome%' or ";
                }    
                
                if ($request->input('tipopessoa')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->tipopessoa' = tipopessoa or ";
                }
                
                if ($request->input('cpfcnpj')!=''){
                    $stringwhereRaw = $stringwhereRaw . "cpfcnpj LIKE '%$request->cpfcnpj%' or ";
                }
                
                if ($request->input('cliente')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->cliente' = cliente or ";
                }
                
                if ($request->input('fornecedor')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->fornecedor' = fornecedor or ";
                }
                
                if ($request->input('funcionario')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->funcionario' = funcionario or ";
                }
                // limpa o último or da query
                $stringwhereRaw = substr($stringwhereRaw, 0, strlen($stringwhereRaw)-4);
                // envio da query
                $consulta = DB::table('cadastros')
                    ->orwhereRaw($stringwhereRaw)
                    ->get();      
                
                break;
                

            case "1":
                
                
                //trecho para criar uma array baseada no request->input(), onde os resultados não informados serão trocados pela string "nulo" a qual será usada para comparação dentro da query
                //$arrayrequestmodificado = $request->input();
                //$arrayrequestmodificadokeys = array_keys($arrayrequestmodificado);
                //
                //for($i=0 ; $i<count($arrayrequestmodificadokeys) ; $i++){
                //    if ($arrayrequestmodificado[$arrayrequestmodificadokeys[$i]]==''){
                //        $arrayrequestmodificado[$arrayrequestmodificadokeys[$i]]='nulo';
                //    }
                //}##################### não usado ##################
                
                
                
                //construir string da query de pesquisa exclusiva
                // os if's irão desconsiderar pesquisa nesses campos caso não informados
                if ($request->input('nome')!=''){
                    $stringwhereRaw = $stringwhereRaw . "nome LIKE '%$request->nome%' and ";
                }    
                
                if ($request->input('tipopessoa')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->tipopessoa' = tipopessoa and ";
                }
                
                if ($request->input('cpfcnpj')!=''){
                    $stringwhereRaw = $stringwhereRaw . "cpfcnpj LIKE '%$request->cpfcnpj%' and ";
                }
                
                if ($request->input('cliente')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->cliente' = cliente and ";
                }
                
                if ($request->input('fornecedor')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->fornecedor' = fornecedor and ";
                }
                
                if ($request->input('funcionario')!=''){
                    $stringwhereRaw = $stringwhereRaw . "'$request->funcionario' = funcionario and ";
                }
                // limpa o ultimo and da query,
                //if (substr($stringwhereRaw, -5) == ' and '){
                $stringwhereRaw = substr($stringwhereRaw, 0, strlen($stringwhereRaw)-5);
                //}
                // envio da query
                $consulta = DB::table('cadastros')
                    ->whereRaw($stringwhereRaw)
                    ->get();
                
                break;
        }
        
        //cria data e hora de agora
        $dataagora = Carbon::now('-3:00')->format('d/m/Y H:i:s');
        
        //salvar form atual para o proximo
        $request->flash();
        
        
        //se bem sucedido mas nenhum registro encontrado, retorna mensagem
        $countconsulta = count($consulta);
        if ($countconsulta==0){
            return view('templates.searchregistry')->with("resultadoconsulta", $consulta)->with('consultanula', "Pesquisa realizada porém nenhum cadastro encontrado - $dataagora");
        //se bem sucedido e com registro encontrado, retorna mensagem
        } else {
            return view('templates.searchregistry')->with("resultadoconsulta", $consulta)->with('consultapositiva', "Pesquisa realizada com sucesso, $countconsulta cadastros encontrados - $dataagora");
        }

        
        //return redirect("/searchregistry") ->withInput();
        
        //print_r ($request->old('cpfcnpj'));  
    }
    
    
    
    
    public function deleteregistry (Request $request){
        //deletar pela chave primária
        Cadastro::destroy($request->input('delete'));
        
        //cria data e hora de agora
        $dataagora = Carbon::now('-3:00')->format('d/m/Y H:i:s');
        
        return redirect("/searchregistry") ->withInput($request->old()) ->with("deletado", "Cadastro $request->delete Deletado com Sucesso - $dataagora");
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
    
    
    
    
    public function editegistrysave(Request $request){
        
        //validação
        $this->validate($request, [
								'codigopessoa' => 'required|numeric|exists:cadastros,codigopessoa',
                                'tipopessoa' => 'required|max:8|in:juridica,fisica',
                                'nome' => 'required|max:120',
                                'cpfcnpj' => 'required|numeric|max:99999999999999',
                                'razaosocial' => 'required_if:tipopessoa,juridica|max:120',
                                'endereco' => 'required|max:120',
                                'numero' => 'nullable|numeric|max:170000',
                                'complemento' => 'nullable|max:20',
                                'cep' => 'required|numeric|max:99999999',
                                'municipio' => 'required|max:100',
                                'cidade' => 'required|max:100',
                                'email' => 'nullable|email|max:100',
                                'telefone' => 'nullable|numeric|max:999999999999999',
                                'celular' => 'nullable|numeric|max:999999999999999',
                                'cliente' => 'nullable|numeric|max:1',
                                'fornecedor' => 'nullable|numeric|max:1',
                                'funcionario' => 'nullable|numeric|max:1']);
		
		// poderia ter feito um controller de validações
        //validação dos campos de relacionamento, pelo menos 1 precisa ser sim
        if (($request->input('cliente') == false) && ($request->input('fornecedor') == false) && ($request->input('funcionario') == false)){
            //retorna a view anterior, com os dados flash da seção anterior + o aviso do erro de pelo menos 1 relacionamento ativo
            return back()->withInput()->with("relacionamento", "Em pelo menos um dos três tipos de relacionamentos o 'Sim' precisa ser selecionado");
        }
        
        
        //validar campos que não podem se repetir em nenhum registro da tabela
        $camposunicos = ['nome', 'cpfcnpj'];
        //varrer os 3 campos da array $camposunicos em toda a tabela
        foreach ($camposunicos as $campovez){
            //realizar uma consulta sql a cada ciclo para verificar se o valor editado do campo do ciclo já existe em algum registro da tabela que não seja o próprio registro a ser editado
            $versecampoexiste = DB::table('cadastros')
                ->where($campovez, '=', $request->input($campovez))
				->where('codigopessoa', '<>', $request->input('codigopessoa'))
                ->count();
            //se o conteudo de 1 dos 2 campos já existir em algum registro que não seja o próprio registro a ser editado, a variável $versecampoexiste terá valor != 0 e retornará a sessão com um aviso para o usuário.
            if ($versecampoexiste>0){
                return back()->withInput()->with("campoexiste", "Já existe um cadastro com este $campovez");
            }
        }
		
        
        //construção da query de update com os dados advindos do input
        $update = DB::table('cadastros')
            ->where('codigopessoa', $request->codigopessoa)
            ->update([//'codigopessoa' => $request->codigopessoa, //não se altera
                        'tipopessoa' => $request->tipopessoa,
                        'nome' => $request->nome,
                        'cpfcnpj' => $request->cpfcnpj,
                        'razaosocial' => $request->razaosocial,
                        'endereco' => $request->endereco,
                        'numero' => $request->numero,
                        'complemento' => $request->complemento,
                        'cep' => $request->cep,
                        'municipio' => $request->municipio,
                        'cidade' => $request->cidade,
                        'email' => $request->email,
                        'telefone' => $request->telefone,
                        'celular' => $request->celular,
                        'cliente' => $request->cliente,
                        'fornecedor' => $request->fornecedor,
                        'funcionario' => $request->funcionario]);
        
        //cria data e hora de agora
        $dataagora = Carbon::now('-3:00')->format('d/m/Y H:i:s');
        $oldcodpessoa = $request->old('codigopessoa');
        //salvainputs para prox pg
        $request->flash();
        return redirect("/searchregistry")->with("editado", "Cadastro $oldcodpessoa Editado com Sucesso - $dataagora");
    }
    
}
