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
        Schema::table("coins", function (Blueprint $table) {
            $table->double("min_value")->after("price");
            $table->double("max_value")->after("min_value");
            $table->integer("profit_percentage")->after("max_value");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns("coins", ["min_value", "max_value", "profit_percentage"]);
    }
};
