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
        Schema::table('sub_essences', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->dropForeign(['main_product_id']);
            $table->dropColumn('main_product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_essences', function (Blueprint $table) {
            $table->foreignId('main_product_id')->nullable()->constrained('products');
        });
    }
};
