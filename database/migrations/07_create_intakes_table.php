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
        Schema::create('intakes', function (Blueprint $table) {
            $table->id();
            $table->string('semester_name');
            $table->string('semester_year');
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('race')->nullable();
            $table->string('religion')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('household_income')->nullable();
            $table->integer('qualification')->nullable();
            $table->string('action')->nullable();
            $table->string('course')->nullable();
            $table->string('course_level')->nullable();
            $table->string('faculty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intakes');
    }
};
