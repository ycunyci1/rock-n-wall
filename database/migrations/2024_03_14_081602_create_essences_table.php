<?php

use App\Models\Essence;
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
        Schema::create('essences', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('sort')->default(500);
            $table->string('display_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('essences');
    }
};
