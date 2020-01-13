@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}<?php//print do erro?>
        </div>
    @endforeach
@endif



@if(session("relacionamento"))
    <div class="alert alert-danger">
        {{session("relacionamento")}}
    </div>
@endif


@if(session("campoexiste"))
    <div class="alert alert-danger">
        {{session("campoexiste")}}
    </div>
@endif


@if(session("cadastrado"))
    <div class="alert alert-success">
        {{session("cadastrado")}}
    </div>
@endif