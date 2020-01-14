@extends("layouts.app")


@section("content")






    {!! Form::open(['url' => '/searchregistry', 'method' => 'post']) !!}

        <div class="row mx-auto justify-content-between col-md-10 col-lg-10 bg-secondary text-white">
            
            <div>
                <h4>Informe os critérios da pesquisa</h4>
                <div class="form-group">
                    {{Form::label('nome', 'Nome da Pessoa: ')}}
                    {{Form::text('nome', '', ["class" => "form-control", 'placeholder' => 'Insira o nome da pessoa'])}}
                </div>
            </div>

            <div class="align-self-center">
                <div class="form-group">
                    {{Form::label('tipopessoa', 'Tipo de Pessoa: ')}}
                    {{Form::select('tipopessoa', ['' => 'Não Informar', 'fisica' => 'Física', 'juridica' => 'Jurídica'], ["class" => "form-control"])}}
                </div>


                <div class="form-group">
                    {{Form::label('cpfcnpj', 'CPF ou CNPJ da Pessoa: ')}}
                    {{Form::text('cpfcnpj', '', ["class" => "form-control", 'placeholder' => 'Apenas Números'])}}
                </div>
            </div>


            <div class="align-self-center">
                <div>
                    {{Form::label('cliente', 'Cliente: ')}}
                    {{Form::select('cliente', ['' => 'Não Informar', '1' => 'Sim', '0' => 'Não'], ["class" => "form-control"])}}    
                </div>


                <div>
                    {{Form::label('fornecedor', 'Fornecedor: ')}}
                    {{Form::select('fornecedor', ['' => 'Não Informar', '1' => 'Sim', '0' => 'Não'], ["class" => "form-control"])}}
                </div>


                <div>
                    {{Form::label('funcionario', 'Funcionário: ')}}
                    {{Form::select('funcionario', ['' => 'Não Informar', '1' => 'Sim', '0' => 'Não'], ["class" => "form-control"])}}
                </div>
            </div>

            <div class="align-self-center"><!--align-self-start-->
                <div>
                    {{Form::label('tipopesquisa', 'Tipo de Pesquisa: ')}}
                    {{Form::select('tipopesquisa', ['0' => 'Abrangente', '1' => 'Exclusiva'], ["class" => "form-control"])}}
                </div>
                <div class="offset-md-3">
                    {{Form::submit('Pesquisar', ["class" => "btn btn-primary"])}}
                </div>
            </div>
        </div>
    {!! Form::close() !!}



    @if(session("deletado"))
        <div class="alert alert-warning row mx-auto justify-content-between col-md-10 col-lg-10">
            {{session("deletado")}}
        </div>
    @endif

    
    
    @if(isset($resultadoconsulta))
    <div class="col-md-12 d-flex justify-content-between bg-dark text-white">
        <div><h4>Resultados da Pesquisa</h4></div>
        <div>
            <h4>
                
            @if(isset($consultapositiva))
            <div class="text-success">
                {{$consultapositiva}}
            </div>
            @endif
                
            @if(isset($consultanula))
            <div class="text-warning">
                {{$consultanula}}
            </div>
            @endif
                
            </h4>
        </div>
    </div>
    <div>
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Ações</th>
              <th scope="col">Nº Resultado</th>
              <th scope="col">Código da Pessoa</th>
              <th scope="col">Tipo de Pessoa</th>
              <th scope="col">Nome</th>
              <th scope="col">CPF/CNPJ</th>
              <th scope="col">Razão Social</th>
              <th scope="col">Endereço</th>
              <th scope="col">Número</th>
              <th scope="col">Complemento</th>
              <th scope="col">CEP</th>
              <th scope="col">Município</th>
              <th scope="col">Cidade</th>
              <th scope="col">e-mail</th>
              <th scope="col">Telefone</th>
              <th scope="col">Celular</th>
              <th scope="col">Cliente</th>
              <th scope="col">Fornecedor</th>
              <th scope="col">Funcionário</th>
              <th scope="col">Criado</th>
              <th scope="col">Modificado</th>
                
            </tr>
          </thead>
          <tbody>
              
              <?php $num=1 ?>
              @foreach ($resultadoconsulta as $consultalinha)
                <tr>
                    <td>
                    
                    
                        {!! Form::open(['url' => '/searchregistry/deleteregistry', 'method' => 'post']) !!}
                            {{Form::hidden('delete', $consultalinha->codigopessoa)}}<?php //dado enviado para identificar o registro será a coluna PK de cada linha?>
                            {{Form::submit('Deletar', ["class" => "btn btn-danger acoes"])}}
                        {!! Form::close() !!}
                        
                        {!! Form::open(['url' => '/searchregistry/editregistry', 'method' => 'post']) !!}
                            {{Form::hidden('editar', $consultalinha->codigopessoa)}}
                            {{Form::submit('Editar', ["class" => "btn btn-warning acoes"])}}
                        {!! Form::close() !!}                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    </td>
                    <th scope="row" class="d-flex justify-content-center">{{$num}}</th>
                    
                    @foreach($consultalinha as $consultacoluna)
                        <td>
                            @if($consultacoluna === 1)
                                <span>Sim</span>
                            @elseif($consultacoluna === 0)
                                <span>Não</span>
                            @else
                                {{$consultacoluna}}
                            @endif
                        </td>
                    @endforeach
                </tr>
              <?php $num++ ?>
              @endforeach
    @endif
              
              
                  
              
              
              
              
            

          </tbody>
        </table>
        
        
       
        
        
        
        
        
        
    </div>

        
        
        
@endsection("content")







