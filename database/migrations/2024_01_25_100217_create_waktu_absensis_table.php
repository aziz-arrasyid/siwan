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
        Schema::create('waktu_absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classroom_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('hari');
            $table->string('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_absensis');
    }
};
