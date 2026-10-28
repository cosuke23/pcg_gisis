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
        Schema::create('thematic_mappings', function (Blueprint $table) {

            $table->id();

            $table->string('map_title');

            $table->string('category');

            $table->string('geometry_type')->default('Point');

            $table->string('location_name');

            $table->string('region')->nullable();

            $table->string('province')->nullable();

            $table->string('municipality')->nullable();

            $table->decimal('latitude', 10, 7);

            $table->decimal('longitude', 11, 7);

            $table->longText('geojson')->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thematic_mappings');
    }
};
