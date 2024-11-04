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
        Schema::create('tbavaliacao', function (Blueprint $table) {
            $table->id('idavaliacao');
            $table->string('descavaliacao', 180)->nullable();
            $table->integer('ratingAvaliacao');
            $table->uuid('idcontratante');
            $table->foreign('idcontratante')->references('idContratante')->on('tbcontratante')
                  ->onUpdate('cascade')->onDelete('cascade');  // Cascade para deletar avaliações quando contratante for deletado

            // Chave estrangeira para contratado (UUID)
            $table->uuid('idcontratado');
            $table->foreign('idcontratado')->references('idContratado')->on('tbcontratado')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbavaliacao', function (Blueprint $table) {
            $table->dropForeign(['idcontratante']);
            $table->dropForeign(['idcontratado']);
        });

        Schema::dropIfExists('tbavaliacao');
    }
};
