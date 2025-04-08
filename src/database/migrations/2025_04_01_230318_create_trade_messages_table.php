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
        Schema::create('trade_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('order_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_messages');
    }
};
