<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('annual_activities', function (Blueprint $table) {

            $table->id();

            $table->string('activity_title');

            $table->date('activity_date');

            $table->string('location');

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->text('description')->nullable();

            $table->string('conducted_by')->nullable();

            $table->string('activity_type');

            $table->integer('participants')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('annual_activities');
    }
};
