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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_surat');
            $table->string('total_ayat');
            $table->string('juz');
            $table->unsignedBigInteger('tahfidz_id');
            $table->unsignedBigInteger('users_id');
            $table->enum('status', [0, 1]);
            $table->timestamps();
            $table->foreign('tahfidz_id')->references('id')->on('tahfidz')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
