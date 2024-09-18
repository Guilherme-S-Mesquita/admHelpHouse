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
            $table->uuid('idContratado')->primary();
            $table->string('nomeContratado', 55);
            $table->string('sobrenomeContratado', 90)->nullable();
            $table->char('cpfContratado', 14)->unique();
            $table->string('emailContratado', 180)->unique();
            $table->char('telefoneContratado', 18)->unique();
            $table->string('password');
            $table->string('profissaoContratado', 90);
            $table->string('descContratado', 400)->nullable();
            $table->date('nascContratado');

            $table->string('ruaContratado', 90);
            $table->string('cepContratado', 9);
            $table->string('numCasaContratado', 14);
            $table->string('complementoContratado')->nullable();
            $table->string('bairroContratado', 90);
            $table->string('ufContratado', 10)->nullable();
            $table->string('cidadeContratado', 50)->nullable();

            $table->string('tokenContratado', 200)->unique()->nullable();
            $table->string('imagemContratado', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbcontratado');
    }
};
