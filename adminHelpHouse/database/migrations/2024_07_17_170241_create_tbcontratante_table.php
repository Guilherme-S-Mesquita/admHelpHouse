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
        Schema::create('tbcontratante', function (Blueprint $table) {
            $table->id('idContratante');
            $table->string('nomeContratante', 55);
            $table->string('sobrenomeContratante', 90);
            $table->char('cpfContratante', 14)->unique();
            $table->string('emailContratante', 180)->unique();
            $table->char('telefoneContratante', 14)->unique();
            $table->unsignedBigInteger('idEndereco');
            
            // $table->timestamp('data_cadastro')->useCurrent(); // Adiciona a coluna de data de cadastro

            $table->foreign('idEndereco')->references('idEndereco')->on('tbenderecos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbcontratante');
    }
};
