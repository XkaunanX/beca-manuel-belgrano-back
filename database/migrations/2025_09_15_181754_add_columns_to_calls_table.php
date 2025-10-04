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
        Schema::table('calls', function (Blueprint $table) {
            $table->float('points')->after('id');
            $table->integer('hours')->after('points');
            $table->date('start_date')->after('hours');
            $table->date('end_date')->after('start_date');
            $table->float('socioeconomic_points_limit')->after('end_date');
            $table->boolean('residency_required')->after('socioeconomic_points_limit');
            $table->date('enrollment_start_date')->nullable()->after('residency_required');
            $table->date('enrollment_end_date')->nullable()->after('enrollment_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropColumn([
                'points',
                'hours',
                'start_date',
                'end_date',
                'socioeconomic_points_limit',
                'residency_required',
                'enrollment_start_date',
                'enrollment_end_date'
            ]);
        });
    }
};
