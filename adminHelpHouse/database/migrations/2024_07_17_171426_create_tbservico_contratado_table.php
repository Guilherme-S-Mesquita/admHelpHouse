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
        Schema::create('tbservico_Contratado', function (Blueprint $table) {
            $table->id('idServicoContratado');
            $table->string('nomeServicoContratado', 150);
            $table->string('descServicoContratado', 400);
            $table->unsignedBigInteger('idContratado');
            $table->unsignedBigInteger('idContratante');
            $table->unsignedBigInteger('idPagamento');
            $table->foreign('idContratado')->references('idContratado')->on('tbcontratado');
            $table->foreign('idContratante')->references('idContratante')->on('tbcontratante');
            $table->foreign('idPagamento')->references('idPagamento')->on('tbpagamento');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbservicocontratado');
    }
};
