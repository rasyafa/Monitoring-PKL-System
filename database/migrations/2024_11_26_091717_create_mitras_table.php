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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan', 255);
            $table->string('bidang_usaha', 255);
            $table->string('no_telpon', 20);
            $table->string('nama_pimpinan', 255);
            $table->text('alamat');
            $table->timestamps();
        });

        // Tabel pivot untuk relasi mentor dan mitra
        Schema::create('mitra_mentor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel pivot untuk relasi pembimbing dan mitra
        Schema::create('mitra_pembimbing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->foreignId('pembimbing_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra_pembimbing');
        Schema::dropIfExists('mitra_mentor');
        Schema::dropIfExists('mitras');
    }
};
