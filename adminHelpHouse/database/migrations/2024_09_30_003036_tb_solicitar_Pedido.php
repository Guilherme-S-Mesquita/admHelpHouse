<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbSolicitarPedido', function (Blueprint $table) {
            $table->id('idSolicitarPedido');
            $table->uuid('idContratante');
            $table->foreign('idContratante')->references('idContratante')->on('tbcontratante')
                  ->onUpdate('cascade')->onDelete('cascade');

            // Referenciando corretamente a coluna idServicos
            $table->foreignId('idServicos')->constrained('tbservicos', 'idServicos')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->string('descricaoPedido');
            // $table->string('servicoPedido');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('tbSolicitarPedido', function (Blueprint $table) {
            $table->dropForeign(['idcontratante']);
            $table->dropForeign(['idServicos']);
        });

        Schema::dropIfExists('tbSolicitarPedido');
    }
};
