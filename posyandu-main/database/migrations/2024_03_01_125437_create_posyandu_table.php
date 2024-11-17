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
        Schema::create('posyandu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id');
            $table->foreignId('posko_id');
            $table->date('tanggal_lahir')->nullable();
            $table->decimal('tinggi_badan', 8, 2)->nullable();
            $table->decimal('berat_badan', 8, 2)->nullable();
            $table->integer('umur')->nullable();
            $table->string('lingkar_lengan')->nullable();
            $table->string('lingkar_kepala')->nullable();
            $table->string('imunisasi')->nullable();
            $table->string('vitamin')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->string('obat_tambah_darah')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posyandu');
    }
};
