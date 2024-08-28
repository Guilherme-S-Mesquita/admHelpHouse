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
            $table->string('sobrenomeContratante', 90)->nullable();
            $table->char('cpfContratante', 14)->unique();
            $table->string('password');
            $table->string('emailContratante', 180)->unique();
            $table->char('telefoneContratante', 14)->unique();

            $table->string('ruaContratante', 90);
            $table->string('cepContratante', 9);
            $table->string('numCasaContratante', 14);
            $table->string('complementoContratante')->nullable();
            $table->string('bairroContratante', 90);
            $table->string('ufContratante', 10)->nullable();
            $table->string('cidadeContratante', 50)->nullable();

        });
    }

    public function down()
    {
        Schema::table('tbcontratante', function (Blueprint $table) {


        });
        Schema::dropIfExists('tbcontratante');
    }
};
