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
                        {{Form::label('municipio', 'Município: ')}}
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










@endsection("content")