<?php

namespace Database\Seeders;

use App\Models\permohonan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class permohonanSeed extends Seeder
{
    /**
     * jalankan database seeds.
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        
        // Kumpulkan users
        $users = DB::table('users')->where('is_admin', false)->get();
        
        foreach ($users as $user) {
            // Membuat permohonan baru sesuai user yang bukan admin
            $permohonan = new permohonan;
            $permohonan->user_id = $user->id;
            $permohonan->kode_permohonan = 'PN-BLB-' . date('Ym') . '-' . sprintf('%04d', $faker->numberBetween(1, 9999));
            $permohonan->jenis_permohonan = $faker->sentence;
            $permohonan->keterangan = $faker->paragraph;
            $permohonan->alasan_permohonan = $faker->paragraph;
            $permohonan->verifikasi = $faker->randomElement(['Pending', 'Terverifikasi', 'Ditolak']);
            
            // Generate fake file 
            $surat_pernyataan = $faker->randomElement([ $faker->file('public/surat_pernyataan', 'public/storage/surat_pernyataan', false)]);
            $suket_pengantar_desa = $faker->randomElement([null, $faker->file('public/suket_pengantar_desa', 'public/storage/suket_pengantar_desa', false)]);
            $suket_pengantar_partai = $faker->randomElement([null, $faker->file('public/suket_pengantar_partai', 'public/storage/suket_pengantar_partai', false)]);
            $pengiriman_berkas = $faker->randomElement([ $faker->file('public/pengiriman_berkas', 'public/storage/pengiriman_berkas', false)]);
            

            // Set the file
            $permohonan->surat_pernyataan = $surat_pernyataan;
            $permohonan->suket_pengantar_desa = $suket_pengantar_desa;
            $permohonan->suket_pengantar_partai = $suket_pengantar_partai;
            $permohonan->pengiriman_berkas = $pengiriman_berkas;
            
            $permohonan->nomor_skck = $faker->numerify('###########');
            
            // Generate a fake image
            $skck = $faker->randomElement([ $faker->file('public/skck', 'public/storage/skck', false)]);
            $bukti_transfer_PNBP = $faker->randomElement([ $faker->file('public/bukti_transfer_PNBP', 'public/storage/bukti_transfer_PNBP', false)]);
            
            // Set bukti_transfer_PNBP file name
            $permohonan->skck = $skck;
            $permohonan->bukti_transfer_PNBP = $bukti_transfer_PNBP;
            
            // Save permohonan
            $permohonan->save();
        }
    }
}
