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
        if (Schema::hasColumn("user_withdrawal_accounts", "payment_method_id")) {
            Schema::dropColumns("user_withdrawal_accounts", ["payment_method_id"]);
        }

        if (!Schema::hasColumn("user_withdrawal_accounts", "bank")) {
            Schema::table("user_withdrawal_accounts", function (Blueprint $table) {
                $table->string("bank")->after("user_id");
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
