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
        Schema::create('tahfidz', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->nullable();
            $table->string('nama');
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('kategori', ['ANAK_PONDOK', 'TPQ']);
            $table->enum('status', ['Aktif', 'Lulus']);
            $table->date('tgl_lahir');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahfidz');
    }
};
