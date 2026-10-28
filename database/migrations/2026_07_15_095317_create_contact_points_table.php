<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('contact_points', function (Blueprint $table) {

            $table->id();

            $table->string('country')->default('Philippines');

            $table->string('name');

            $table->string('email');

            $table->string('telephone')->nullable();

            $table->string('position');

            $table->string('agency')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('contact_points');
    }
};
