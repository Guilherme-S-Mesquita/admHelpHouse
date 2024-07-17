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
            $table->string('descavaliacao', 180);
            $table->unsignedBigInteger('idcontratado');
            $table->unsignedBigInteger('idcontratante');
            $table->foreign('idcontratado')->references('idContratado')->on('tbcontratado');
            $table->foreign('idcontratante')->references('idContratante')->on('tbcontratante');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbavaliacao');
    }
};
