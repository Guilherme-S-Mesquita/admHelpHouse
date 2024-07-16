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
        Schema::create('avaliar', function (Blueprint $table) {
            $table->id('idAvaliacao');
            $table->string('descAvaliacao', 500);

          // unsignedBigInteger é usado para quando for preciso pegar alguma informação de outra tabela, no caso ID


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumn('avaliar');

    }
};
