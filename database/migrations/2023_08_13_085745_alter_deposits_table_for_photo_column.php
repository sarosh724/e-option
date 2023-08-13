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
        if (!Schema::hasColumn("deposits", "photo")) {
            Schema::table("deposits", function (Blueprint $table) {
                $table->string("photo")->after("status");
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn("deposits", "photo")) {
            Schema::dropColumns("deposits", ["photo"]);
        }
    }
};
