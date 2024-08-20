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
            $table->string('nomeContato', 70);
            $table->string('sobrenomeContato', 80);
            $table->char('telefoneContato', 14)->unique();
            $table->string('emailContato', 120)->unique();
            $table->string('descContato', 300);
            $table->unsignedBigInteger('idContratado');
            $table->unsignedBigInteger('idContratante');
            $table->foreign('idContratado')->references('idContratado')->on('tbcontratado');
            $table->foreign('idContratante')->references('idContratante')->on('tbcontratante');
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
