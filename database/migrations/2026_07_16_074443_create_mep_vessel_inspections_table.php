<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mep_vessel_inspections', function (Blueprint $table) {

            $table->id();

            $table->string('inspection_number')->unique();

            $table->date('inspection_date');

            $table->string('vessel_name');

            $table->string('official_number')->nullable();

            $table->string('imo_number')->nullable();

            $table->string('call_sign')->nullable();

            $table->string('flag')->nullable();

            $table->string('vessel_type')->nullable();

            $table->string('owner')->nullable();

            $table->string('master')->nullable();

            $table->string('inspection_location');

            $table->string('inspector_name');

            $table->enum('inspection_status',[
                'Pending',
                'Passed',
                'Failed',
                'For Correction'
            ])->default('Pending');

            $table->text('remarks')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mep_vessel_inspections');
    }
};
