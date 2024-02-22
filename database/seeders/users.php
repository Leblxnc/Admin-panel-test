<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $password = 'test';

        $hashedPassword = Hash::make($password);

        // Membuat admin user
        DB::table('users')->insert([
            'email' => 'admin@example.com',
            'password' => $hashedPassword,
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Membuat 50 user biasa
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'password' => $hashedPassword,
                'is_admin' => false,
                'email_verified_at' =>$faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

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
                'kk' => $faker->imageUrl($width = 640, $height = 480),
                'jenis_identitas' => $faker->randomElement(['ktp', 'sim', 'pasport']),
                'identitas' => $faker->imageUrl($width = 640, $height = 480),
                'nomor_identitas' => $faker->numerify('###########'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
