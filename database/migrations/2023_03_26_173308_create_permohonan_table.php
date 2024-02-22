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
        Schema::create('permohonan', function (Blueprint $table) {
            $table->bigIncrements('pm_id');
            $table->unsignedBigInteger('user_id');
            $table->string('kode_permohonan')->default('PN-BLB-' . date('Ym') . '-0001');
            $table->string('jenis_permohonan');
            $table->text('alasan_permohonan');
            $table->string('nomor_skck');
            $table->string('skck')->nullable();//image
            $table->string('surat_pernyataan');//file
            $table->string('suket_pengantar_partai')->nullable();//file
            $table->string('suket_pengantar_desa')->nullable();//file
            $table->string('pengiriman_berkas');//file
            $table->string('Tagihan')->nullable();
            $table->string('bukti_transfer_PNBP');//image
            $table->string('surat_dimohon')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('verifikasi', ['Pending','Terverifikasi','Ditolak']);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan');
    }
};
