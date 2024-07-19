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
        Schema::create('tbservicoContratado', function (Blueprint $table) {
            $table->id('idServicoContratado');
            $table->string('nomeServicoContratado', 150);
            $table->string('descServicoContratado', 400);
            $table->unsignedBigInteger('idContratado');
            $table->unsignedBigInteger('idContratante');
            $table->unsignedBigInteger('idPagamento');

            // Definição das chaves estrangeiras
            $table->foreign('idContratado')->references('idContratado')->on('tbcontratado')->onDelete('cascade');
            $table->foreign('idContratante')->references('idContratante')->on('tbcontratante')->onDelete('cascade');
            $table->foreign('idPagamento')->references('idPagamento')->on('tbpagamento')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        // Primeiro, removemos as chaves estrangeiras
        Schema::table('tbservicoContratado', function (Blueprint $table) {
            $table->dropForeign(['idContratado']);
            $table->dropForeign(['idContratante']);
            $table->dropForeign(['idPagamento']);
        });

        // Em seguida, removemos a tabela
        Schema::dropIfExists('tbservicoContratado');
    }
};
