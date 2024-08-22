<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbEnderecos', function (Blueprint $table) {
            $table->id('idEndereco');
            $table->string('ruaEndereco', 90);
            $table->string('cepEndereco', 9);
            $table->string('numCasaEndereco', 14);
            $table->string('complementoEndereco')->nullable();
            $table->string('bairroEndereco', 90);
            $table->string('ufEndereco', 10);
            $table->string('cidadeEndereco', 50);
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbEnderecos');
    }
};
