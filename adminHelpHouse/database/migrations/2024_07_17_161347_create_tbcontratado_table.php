<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbcontratado', function (Blueprint $table) {
            $table->id('idContratado');
            $table->string('nomeContratado', 55);
            $table->string('sobrenomeContratado', 90);
            $table->char('cpfContratado', 14)->unique();
            $table->string('emailContratado', 180)->unique();
            $table->char('telefoneContratado', 14)->unique();
            // $table->timestamp('data_cadastro')->useCurrent(); // Adiciona a coluna de data de cadastro
            
            // Definindo colunas para armazenar os IDs do endereco
            // unsignedBigInteger é usado para garantir que o ID seja positivo e grande o suficiente
            $table->unsignedBigInteger('idEndereco');
            $table->string('senhaContratado', 8);
            $table->string('profissaoContratado', 90);
            $table->string('descContratado', 400);
            $table->date('nascContratado');
            $table->string('tokenContratado', 200)->unique();
            $table->string('imagemContratado', 100);


            // Definindo chave estrangeira para idContratante
            // 1. 'idEndereco' será uma chave estrangeira nesta tabela ('tbContratado')
            // 2. 'references' define a coluna ('id') na tabela 'tbEndereco' que será referenciada
            // 3. 'on' especifica a tabela 'tbEnderecos' de onde a coluna 'idEndereco' está sendo referenciada
            $table->foreign('idEndereco')->references('idEndereco')->on('tbenderecos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbcontratado');
    }
};
