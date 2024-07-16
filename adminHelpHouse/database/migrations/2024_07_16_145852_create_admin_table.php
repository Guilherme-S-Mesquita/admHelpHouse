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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('idAdmin' );
            $table->string('nomeAdmin', 55);
            $table->string('sobrenomeAdmin', 90);
            $table->string('cpfAdmin', 14)->Unique();
            $table->date('nascAdmin');
            $table->string('emailAdmin', 180)->Unique();
            $table->string('senhaAdmin', 50);
            $table->string('imageAdmin', 50);
            $table->string('tokenAdmin', 50)->unique();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
