<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->unsignedInteger('years');
            $table->unsignedInteger('subject_count');

            // Claves foraneas
            $table->foreignId('level_id')->constrained()->onDelete('cascade');
            $table->foreignId('career_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');

            $table->timestamps();

            // Restriccion unica para evitar duplicados innecesarios
            $table->unique(['career_id', 'unit_id', 'name'], 'academic_plan_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_plans');
    }
};