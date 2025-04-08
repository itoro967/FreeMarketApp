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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->string('payment');
            $table->string('post_code');
            $table->string('address');
            $table->string('building');
            $table->boolean('is_completed')->default(false);
            // 売り手の評価
            $table->unsignedTinyInteger('seller_rating')->nullable();
            // 買い手の評価
            $table->unsignedTinyInteger('buyer_rating')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
