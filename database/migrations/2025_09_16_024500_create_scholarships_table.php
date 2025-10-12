<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->nullable()->constrained('genres')->onDelete('set null');
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('cuil')->nullable();
            $table->string('cuit')->nullable();
            $table->integer('children')->default(0);
            $table->string('social_coverage')->nullable();

            // Relaciones adicionales
            $table->foreignId('civil_status_id')->nullable()->constrained('civil_statuses')->onDelete('set null');
            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->onDelete('set null');
            $table->foreignId('vulnerable_group_id')->nullable()->constrained('vulnerable_groups')->onDelete('set null');
            $table->foreignId('bank_branch_id')->nullable()->constrained('bank_branches')->onDelete('set null');

            // Relación con state (ya existe la tabla 'states')
            $table->foreignId('state_id')->nullable()->constrained('states')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
