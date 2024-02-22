<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class datadiri extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Membuat datadiri dengan kriteria user bukan admin
        $users = DB::table('users')->where('is_admin', false)->get();

        foreach ($users as $user) {
            DB::table('datadiri')->insert([
                'user_id' => $user->id,
                'foto' => $faker->imageUrl($width = 640, $height = 480),
                'nama_lengkap' => $faker->name,
                'tanggal_lahir' => $faker->date,
                'tempat_lahir' => $faker->city,
                'jenis_kelamin' => $faker->randomElement(['Pria', 'Wanita']),
                'agama' => $faker->randomElement(['Islam','Kristen Protestan','Katolik', 'Hindu', 'Budha', 'Konghucu', 'Lainya']),
                'pendidikan_terakhir' => $faker->randomElement(['SD', 'SMP/Sederajat', 'SMA/Sederajat', 'Diploma', 'S1', 'S2', 'S3', 'Lainya']),
                'scan_ijazah' => $faker->imageUrl($width=640, $height=480),
                'alamat' => $faker->address,
                'no_telp' => $faker->phoneNumber,
                'pekerjaan' => $faker->jobTitle,
                'identitas' => $faker->imageUrl($width = 640, $height = 480),
                'nomor_identitas' => $faker->numerify('###########'),
                'ktp' => $faker->imageUrl($width = 640, $height = 480),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
