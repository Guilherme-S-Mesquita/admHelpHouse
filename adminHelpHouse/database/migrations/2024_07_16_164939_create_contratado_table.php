<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contratado', function (Blueprint $table) {
            $table->id('idContratado');
            $table->string('nomeContratado', 55);
            $table->string('sobrenomeContratado', 90);
            $table->string('cpfContratado', 14)-> unique();
            $table->string('emailContratado', 180)->unique();
            $table->string('telefoneContratado', 14);
        //    $table->unsignedBigInteger('idEndereco', 11);
            $table->string('senhaContratado');
            $table->string('certificadosContratado')->nullable();
            $table->string('descContratado', 400);
            $table->date('nascContratado');
            $table->string('tokenContratado')->unique();
            $table->string('imagemContratado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratado');
    }
};
