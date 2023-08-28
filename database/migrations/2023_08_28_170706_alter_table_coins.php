<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE coins CHANGE COLUMN profit_percentage buy_profit INTEGER NULL;');
        Schema::table("coins", function (Blueprint $table) {
            $table->integer("sell_profit")->nullable()->after("buy_profit");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
