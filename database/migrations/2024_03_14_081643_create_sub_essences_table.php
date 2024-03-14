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
        Schema::create('sub_essences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('main_product_id');
            $table->foreign('main_product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('essence_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_essences');
    }
};
