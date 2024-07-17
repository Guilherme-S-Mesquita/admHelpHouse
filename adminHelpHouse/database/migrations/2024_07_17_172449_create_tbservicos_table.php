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
                $table->string('descServicos', 400);
                $table->unsignedBigInteger('idContratado');
                $table->foreign('idContratado')->references('idContratado')->on('tbcontratado');
            });
        }

        public function down()
        {
            Schema::dropIfExists('tbservicos');
        }
};
