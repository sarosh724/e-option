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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable(false);
            $table->unsignedBigInteger("coin_id")->nullable(false);
            $table->string("label", 10);
            $table->double("amount_invested", 8, 2);
            $table->string("time_period");
            $table->enum("result", ['Profit', 'Lose']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
