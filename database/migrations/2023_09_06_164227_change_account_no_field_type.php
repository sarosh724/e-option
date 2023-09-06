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
        Schema::table("user_withdrawal_accounts", function (Blueprint $table) {
            $table->string("account_number", 200)->change();
        });

        Schema::table("payment_methods", function (Blueprint $table) {
            $table->string("account_no", 200)->change();
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
