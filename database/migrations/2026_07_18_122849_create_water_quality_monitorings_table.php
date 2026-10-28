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
        Schema::create('water_quality_monitorings', function (Blueprint $table) {

            $table->id();

            // Report Information
            $table->string('report_number')->unique();
            $table->date('monitoring_date');

            // Location
            $table->string('monitoring_station');
            $table->string('body_of_water');

            $table->string('region');
            $table->string('province');
            $table->string('city_municipality');
            $table->string('barangay')->nullable();

            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // Water Parameters
            $table->decimal('temperature', 5, 2)->nullable();
            $table->decimal('ph_level', 4, 2)->nullable();
            $table->decimal('dissolved_oxygen', 5, 2)->nullable();
            $table->decimal('salinity', 5, 2)->nullable();
            $table->decimal('turbidity', 6, 2)->nullable();
            $table->decimal('conductivity', 8, 2)->nullable();
            $table->decimal('ammonia', 5, 2)->nullable();
            $table->decimal('nitrate', 5, 2)->nullable();
            $table->decimal('phosphate', 5, 2)->nullable();

            // Assessment
            $table->enum('water_quality_status', [
                'Good',
                'Fair',
                'Poor',
                'Critical'
            ]);

            $table->string('pollution_source')->nullable();

            $table->text('observed_condition')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('remarks')->nullable();

            // Personnel
            $table->string('inspector_name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_quality_monitorings');
    }
};
