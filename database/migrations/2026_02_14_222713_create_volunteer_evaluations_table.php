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

        Schema::create('volunteer_evaluations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('volunteer_id')->constrained()->cascadeOnDelete();

            $table->unsignedTinyInteger('attitude_score');
            $table->unsignedTinyInteger('skills_score');
            $table->unsignedTinyInteger('responsibility_score');

            $table->text('strengths');
            $table->text('improvements')->nullable();

            $table->timestamps();

            $table->unique(['project_id', 'volunteer_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_evaluations');
    }
};
