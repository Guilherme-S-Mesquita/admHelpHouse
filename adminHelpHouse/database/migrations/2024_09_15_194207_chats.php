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
        Schema::create('chats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('chat_room_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('idContratante')->nullable()->constrained('tbcontratante', 'idContratante')->onUpdate('cascade')->onDelete('set null');
            $table->foreignUuid('idContratado')->nullable()->constrained('tbcontratado', 'idContratado')->onUpdate('cascade')->onDelete('set null');
            $table->text('message')->nullable(false);
            $table->boolean('is_read')->default(false)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
