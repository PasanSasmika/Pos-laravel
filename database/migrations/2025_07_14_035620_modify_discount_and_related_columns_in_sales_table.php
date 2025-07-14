<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('discount', 15, 2)->change();
            $table->decimal('tax', 15, 2)->change();
            $table->decimal('total_amount', 15, 2)->change(); // Ensure this is also updated
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('discount', 8, 2)->change();
            $table->decimal('tax', 8, 2)->change();
            $table->decimal('total_amount', 8, 2)->change();
        });
    }
};