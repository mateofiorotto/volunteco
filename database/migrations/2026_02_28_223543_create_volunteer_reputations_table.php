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
        Schema::create('volunteer_reputations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('volunteers')->cascadeOnDelete();

            // Rating
            $table->decimal('average_rating', 3, 2)->default(0); // 0.00 - 5.00
            $table->unsignedInteger('total_evaluations')->default(0);

            // Experiencia
            $table->unsignedInteger('completed_projects')->default(0);
            $table->unsignedInteger('cancelled_projects')->default(0);

            // Confiabilidad
            $table->decimal('completion_rate', 5, 2)->default(0); // 0 - 100 %

            // Score calculado
            $table->decimal('trust_score', 5, 2)->default(0); // 0 - 100
            $table->enum('trust_level',['inicial', 'activo', 'destacado', 'embajador'])->default('inicial');

            $table->timestamps();

            $table->unique('volunteer_id'); // 1 reputación por voluntario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volunteer_reputations');
    }
};
