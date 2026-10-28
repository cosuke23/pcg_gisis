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
        Schema::create('mep_land_inspections', function (Blueprint $table) {

            $table->id();

            $table->string('inspection_number')->unique();

            $table->date('inspection_date');

            $table->string('facility_name');

            $table->string('facility_type')->nullable();

            $table->string('owner')->nullable();

            $table->string('permit_number')->nullable();

            $table->string('inspection_location');

            $table->string('city_municipality')->nullable();

            $table->string('province')->nullable();

            $table->string('inspector_name');

            $table->enum('compliance_status', [

                'Pending',

                'Compliant',

                'Non-Compliant',

                'For Reinspection'

            ])->default('Pending');

            $table->text('findings')->nullable();

            $table->text('recommendations')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mep_land_inspections');
    }
};
