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
        Schema::create('coral_assessments', function (Blueprint $table) {

            $table->id();

            $table->string('assessment_number')->unique();

            $table->date('assessment_date');

            $table->string('site_name');

            $table->string('region');

            $table->string('province');

            $table->string('municipality');

            $table->decimal('latitude', 10, 7);

            $table->decimal('longitude', 11, 7);

            $table->longText('geojson')->nullable();

            $table->enum('reef_type', [
                'Fringing Reef',
                'Barrier Reef',
                'Patch Reef',
                'Atoll',
                'Artificial Reef'
            ]);

            $table->enum('assessment_method', [
                'LIT',
                'Photo Transect',
                'Quadrat',
                'Manta Tow',
                'Visual Survey'
            ]);

            $table->decimal('live_coral_cover', 5, 2)->nullable();

            $table->decimal('dead_coral_cover', 5, 2)->nullable();

            $table->decimal('algae_cover', 5, 2)->nullable();

            $table->decimal('sand_cover', 5, 2)->nullable();

            $table->enum('reef_condition', [
                'Excellent',
                'Good',
                'Fair',
                'Poor',
                'Critical'
            ]);

            $table->boolean('rehabilitation_required')->default(false);

            $table->date('rehabilitation_start')->nullable();

            $table->date('rehabilitation_end')->nullable();

            $table->string('rehabilitation_method')->nullable();

            $table->string('implementing_agency')->nullable();

            $table->string('team_leader');

            $table->text('remarks')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coral_assessments');
    }
};
