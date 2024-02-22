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
        Schema::create('datadiri', function (Blueprint $table) {
            $table->id('dr_id');
            $table->unsignedBigInteger('user_id');
            $table->string('foto')->nullable()->nullable();//gambar
            $table->string('nama_lengkap')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->string('agama')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('scan_ijazah')->nullable();//gambar
            $table->string('alamat')->nullable();//sesuai identitas
            $table->string('no_telp')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kk')->nullable();//gambar
            $table->string('jenis_identitas')->nullable();
            $table->string('nomor_identitas')->nullable();
            $table->string('identitas')->nullable();//gambar
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datadiri');
    }
};
