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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->boolean('enabled')->default(true);
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            $table->enum('work_hours_per_day', ['2 Horas', '4 Horas', '6 Horas', '8 Horas']);
            $table->foreignId('project_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('host_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
