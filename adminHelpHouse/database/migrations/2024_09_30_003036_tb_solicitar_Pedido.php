<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tbSolicitarPedido', function (Blueprint $table) {
            $table->id('idSolicitarPedido');

            // Criação do idContratante como uuid
            $table->uuid('idContratante');
            $table->foreign('idContratante')->references('idContratante')->on('tbcontratante')
                ->onUpdate('cascade')->onDelete('cascade');

            // Criação do idContratado como uuid (corrigido)
            $table->uuid('idContratado');
            $table->foreign('idContratado')->references('idContratado')->on('tbcontratado')
                ->onUpdate('cascade')->onDelete('cascade');

            // Criação do idServicos como foreignId
            $table->foreignId('idServicos')->constrained('tbservicos', 'idServicos')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string( 'descricaoPedido');
            $table->string( 'tituloPedido');
            $table->enum('statusPedido', ['pendente', 'aceito', 'recusado'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('tbSolicitarPedido', function (Blueprint $table) {
            $table->dropForeign(['idContratante']);
            $table->dropForeign(['idContratado']);
            $table->dropForeign(['idServicos']);
        });

        Schema::dropIfExists('tbSolicitarPedido');
    }
};
