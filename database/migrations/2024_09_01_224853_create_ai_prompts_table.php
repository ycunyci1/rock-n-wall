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
        //descriptionPrompt, model, guidanceScale
        Schema::create('ai_prompts', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('model');
            $table->string('guidanceScale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_prompts');
    }
};
