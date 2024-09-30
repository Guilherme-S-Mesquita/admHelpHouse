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
        Schema::create('tbservicos', function (Blueprint $table) {
            $table->id('idServicos');
            $table->string('nomeServicos', 50);
            $table->string('descServicos', 400);
            $table->string('categoriaServicos', 40);
          


          // Chave estrangeira para contratado (agora usando unsignedBigInteger)
        //   $table->uuid('idcontratado');
        //   $table->foreign('idcontratado')->references('idContratado')->on('tbcontratado')
        //         ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbservicos', function (Blueprint $table) {
            // $table->dropForeign(['idContratado']);
        });
        Schema::dropIfExists('tbservicos');
    }
};
