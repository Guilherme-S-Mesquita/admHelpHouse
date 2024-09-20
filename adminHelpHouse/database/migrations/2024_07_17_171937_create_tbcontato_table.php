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
        Schema::create('tbcontato', function (Blueprint $table) {
            $table->id('idContato');
            $table->string('numeroTelefone');
             
         // Chave estrangeira para contratante (agora usando unsignedBigInteger)
         $table->unsignedBigInteger('idcontratante');
         $table->foreign('idcontratante')->references('idContratante')->on('tbcontratante')
               ->onUpdate('cascade')->onDelete('cascade');

         // Chave estrangeira para contratado (agora usando unsignedBigInteger)
         $table->unsignedBigInteger('idcontratado');
         $table->foreign('idcontratado')->references('idContratado')->on('tbcontratado')
               ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::table('tbcontato', function (Blueprint $table) {
            $table->dropForeign(['idContratado']);
            $table->dropForeign(['idContratante']);

        });
        Schema::dropIfExists('tbcontato');
    }
};
