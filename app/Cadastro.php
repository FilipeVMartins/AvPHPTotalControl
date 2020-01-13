<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cadastro extends Model
{
    //Substituir a PK 'id' padrão do eloquent por 'codigopessoa'
    protected $primaryKey = 'codigopessoa';
}
