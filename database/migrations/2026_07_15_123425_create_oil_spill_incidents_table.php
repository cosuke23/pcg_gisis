<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oil_spill_incidents', function (Blueprint $table) {

            $table->id();

            $table->string('incident_number')->unique();

            $table->date('incident_date');

            $table->time('incident_time');

            $table->string('spill_type');

            $table->string('spill_source');

            $table->decimal('estimated_volume', 12, 2)->nullable();

            $table->string('volume_unit')->default('Liters');

            $table->string('severity_level');

            $table->string('affected_area');

            $table->decimal('latitude', 10, 7);

            $table->decimal('longitude', 10, 7);

            $table->text('description')->nullable();

            $table->string('response_status')->default('Ongoing');

            $table->foreignId('contact_point_id')->nullable();

            $table->foreignId('dump_site_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oil_spill_incidents');
    }
};
