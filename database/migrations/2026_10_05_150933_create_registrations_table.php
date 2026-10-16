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
        Schema::create('registrations', function (Blueprint $table) {
             $table->id();

             $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

             $table->foreignId('formation_id')->constrained('formations')->onDelete('cascade');

             $table->date('date_inscription');

             $table->string('statut')->default('active');

             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
