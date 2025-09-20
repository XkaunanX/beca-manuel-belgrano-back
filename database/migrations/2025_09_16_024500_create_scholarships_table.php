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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();

            // Campos basicos
            $table->string('name');
            $table->string('last_name');
            $table->date('date_birth');
            $table->string('cuil')->nullable();
            $table->string('cuit')->nullable();
            $table->integer('children')->default(0);
            $table->boolean('social_coverage')->default(false);

            // Relaciones (FK)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained('genres')->onDelete('restrict');
            $table->foreignId('nationality_id')->constrained()->onDelete('restrict');
            $table->foreignId('civil_status_id')->constrained()->onDelete('restrict');
            $table->foreignId('vulnerable_group_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('bank_branch_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
