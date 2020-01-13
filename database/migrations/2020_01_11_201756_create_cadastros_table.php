<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastros', function (Blueprint $table) {
            $table->bigIncrements('codigopessoa');
            $table->string('tipopessoa', 8);
            $table->string('nome', 120);
            $table->string('cpfcnpj', 14);
            $table->string('razaosocial', 120)->nullable();
            $table->string('endereco', 120);
            $table->string('numero', 6)->nullable();
            $table->string('complemento', 20)->nullable();
            $table->string('cep', 8);
            $table->string('municipio', 100);
            $table->string('cidade', 100);
            $table->string('email', 100)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->boolean('cliente');
            $table->boolean('fornecedor');
            $table->boolean('funcionario');
            $table->timestamps();
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cadastros');
    }
}
