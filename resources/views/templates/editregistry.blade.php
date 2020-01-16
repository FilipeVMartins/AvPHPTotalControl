@extends("layouts.app")


@section("content")

    <h1>Alteração de Cadastro de Pessoas</h1>
    {!! Form::open(['url' => '/searchregistry/editregistry/save', 'method' => 'post']) !!}
        <div class="row mx-auto">
            <div class="col-md-5 col-lg-5">

                <div class="form-group">
                    {{Form::label('codigopessoa', 'Código da Pessoa (Não se Altera): ')}}
                    {{Form::number('codigopessoa', '', ["class" => "form-control", "required", "disabled", 'placeholder' => 'Insira o código da pessoa'])}}
                    {{Form::hidden('codigopessoa', '', ["class" => "form-control", "required", 'placeholder' => 'Insira o código da pessoa'])}}
                </div>


                <div class="form-group">
                    {{Form::label('tipopessoa', 'Tipo de Pessoa: ')}}
                    {{Form::select('tipopessoa', ['fisica' => 'Física', 'juridica' => 'Jurídica'], ["class" => "form-control", "required"])}}
                </div>


                <div class="form-group">
                    {{Form::label('nome', 'Nome da Pessoa: ')}}
                    {{Form::text('nome', '', ["class" => "form-control", 'required', 'placeholder' => 'Insira o nome da pessoa'])}}<?php // é necessário ter o segundo parâmetro, nem que seja uma string vazia ""?>
                </div>


                <div class="form-group">
                    {{Form::label('cpfcnpj', 'CPF ou CNPJ da Pessoa: ')}}
                    {{Form::text('cpfcnpj', '', ["class" => "form-control", 'required', 'placeholder' => 'Apenas Números'])}}
                </div>


                <div class="form-group">
                    {{Form::label('razaosocial', 'Razão Social: ')}}
                    {{Form::text('razaosocial', '', ["class" => "form-control", 'placeholder' => ''])}}
                </div>
            </div>

            <div class="col-md-7 col-lg-7">
                <div class="d-flex justify-content-between">
                    <div class="form-group w-50">
                        {{Form::label('endereco', 'Endereço: ')}}
                        {{Form::text('endereco', '', ["class" => "form-control", 'required', 'placeholder' => ''])}}
                    </div>


                    <div class="form-group">
                        {{Form::label('numero', 'Número: ')}}
                        {{Form::text('numero', '', ["class" => "form-control", 'placeholder' => ''])}}
                    </div>


                    <div class="form-group">
                        {{Form::label('complemento', 'Complemento: ')}}
                        {{Form::text('complemento', '', ["class" => "form-control", 'placeholder' => ''])}}
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="form-group w-33">
                        {{Form::label('cep', 'CEP: ')}}
                        {{Form::text('cep', '', ["class" => "form-control", 'required', 'placeholder' => 'Apenas Números'])}}
                    </div>


                    <div class="form-group w-33">
                        {{Form::label('municipio', 'UF')}}
                        {{Form::text('municipio', '', ["class" => "form-control", 'required', 'placeholder' => ''])}}
                    </div>


                    <div class="form-group w-33">
                        {{Form::label('cidade', 'Cidade: ')}}
                        {{Form::text('cidade', '', ["class" => "form-control", 'required', 'placeholder' => ''])}}
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="form-group w-33">
                        {{Form::label('email', 'E-mail: ')}}
                        {{Form::email('email', '', ["class" => "form-control", 'placeholder' => 'exemplo@gmail.com'])}}
                    </div>


                    <div class="form-group w-33">
                        {{Form::label('telefone', 'Telefone: ')}}
                        {{Form::tel('telefone', '', ["class" => "form-control", 'placeholder' => ''])}}
                    </div>


                    <div class="form-group w-33">
                        {{Form::label('celular', 'Celular: ')}}
                        {{Form::tel('celular', '', ["class" => "form-control", 'placeholder' => ''])}}
                    </div>
                </div>


                <div>
                    <p>Selecione 'Sim' em pelo menos um dos 3 relacionamentos abaixo:</p>
                    <div>
                        <span>Cliente: &nbsp;</span>
                        {{Form::label('cliente', 'Sim')}}
                        {{Form::radio('cliente', 1, ["class" => ""])}}
                        {{Form::label('cliente', 'Não')}}
                        {{Form::radio('cliente', 0, true, ["class" => ""])}}
                    </div>


                    <div>
                        <span>Fornecedor: &nbsp;</span>
                        {{Form::label('fornecedor', 'Sim')}}
                        {{Form::radio('fornecedor', 1, ["class" => ""])}}
                        {{Form::label('fornecedor', 'Não')}}
                        {{Form::radio('fornecedor', 0, true, ["class" => ""])}}
                    </div>


                    <div>
                        <span>Funcionário: &nbsp;</span>
                        {{Form::label('funcionario', 'Sim')}}
                        {{Form::radio('funcionario', 1, ["class" => ""])}}
                        {{Form::label('funcionario', 'Não')}}
                        {{Form::radio('funcionario', 0, true, ["class" => ""])}}
                    </div>

                </div>
            </div>
        </div>  

        <div class="d-flex justify-content-start">
            {{Form::submit('Salvar Alterações', ["class" => "btn btn-primary"])}}
            <a href="http://avphptotalcontrol.work/searchregistry"><div class="btn btn-warning ml-md-2">Cancelar</div></a>
        </div>
    {!! Form::close() !!}











		<!-- Adicionando JQuery -->
    	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


		<!-- Adicionando Javascript -->
    	<script type="text/javascript" >
			
			
			
			
			//$('#tipopessoa').change(function() {
				//funcao para checar valor do campo que determina a escolha do tipo de pessoa

					
					
				//Quando o campo cpfcnpj perde o foco.
				$("#cpfcnpj").blur(function() {
						
					//iniciará após checar se o valor do tipo pessoa é 'juridica'
					if ($("#tipopessoa").val()=='juridica'){


						//declaração da função para limpar razao social e nome fantasia quando falhe
						function limpa_formulário_cpfcnpj() {
							// Limpa valores do formulário de cep.
							$("#razaosocial").val("");
							$("#nome").val("");
						}					
					
					
						
						//Nova variável "cpfcnpj" somente com dígitos.
						var cpfcnpj = $(this).val().replace(/\D/g, '');
						
						
						
						//Verifica se campo cpfcnpj possui valor informado.
						if (cpfcnpj != "") {
							
							//Preenche os campos a serem obtidos com "..." enquanto consulta o webservice.
							$("#razaosocial").val("...");
							$("#nome").val("...");
							
							//Consulta o webservice receitaws.com.br
							$.getJSON(`https://www.receitaws.com.br/v1/cnpj/${cpfcnpj}?callback=?`, function(resposta) {
								

								if (!("ERROR" in resposta)) {
									//Atualiza os campos com os valores da consulta.
									$("#razaosocial").val(resposta.nome);
									$("#nome").val(resposta.fantasia);
								} //end if.
								else {
									//caso cpfcnpj pesquisado não foi encontrado.
									limpa_formulário_cpfcnpj();
									alert("CNPJ não encontrado.");
								}
							});
							
						} else {
							//cpfcnpj sem valor, limpa formulário.
							limpa_formulário_cpfcnpj();
						}	
					}
				});
			
			

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#endereco").val("");
                $("#municipio").val("");
                $("#cidade").val("");
				$("#complemento").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#municipio").val("...");
                        $("#cidade").val("...");
						$("#complemento").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro + ', ' + dados.bairro); //somar bairro
                                $("#municipio").val(dados.uf); //troquei para UF pois não existia municipio na api
                                $("#cidade").val(dados.localidade);
								$("#complemento").val(dados.complemento);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>

@endsection("content")