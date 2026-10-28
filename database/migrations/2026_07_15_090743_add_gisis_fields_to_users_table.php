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
        Schema::table('users', function (Blueprint $table) {

            $table->string('employee_no')->nullable()->after('id');

            $table->string('agency')->default('Philippine Coast Guard')->after('email');

            $table->string('office')->nullable()->after('agency');

            $table->string('position')->nullable()->after('office');

            $table->string('country')->default('Philippines')->after('position');

            $table->enum('role', [
                'Administrator',
                'Encoder',
                'Reviewer',
                'Viewer'
            ])->default('Encoder')->after('country');

            $table->enum('status', [
                'Active',
                'Inactive'
            ])->default('Active')->after('role');

            $table->timestamp('last_login')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'employee_no',
                'agency',
                'office',
                'position',
                'country',
                'role',
                'status',
                'last_login'
            ]);

        });
    }
};