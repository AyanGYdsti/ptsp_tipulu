<?php

namespace Database\Seeders;

use App\Models\Aparatur;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::create([
        //     'username' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => 'pass1234',
        // ]);

        $aparatur = [
            [
                'nama' => 'Andika',
                'jabatan' => 'Lurah',
                'foto' => 'assets/img/avatar.jpg',
                'posisi' => 1,
            ],
            [
                'nama' => 'Yaya',
                'jabatan' => 'Sekretaris',
                'foto' => 'assets/img/avatar.jpg',
                'posisi' => 2,
            ],
            [
                'nama' => 'Tendri',
                'jabatan' => 'Kepala Seksi',
                'foto' => 'assets/img/avatar.jpg',
                'posisi' => 3,
            ],
            [
                'nama' => 'Admin',
                'jabatan' => 'Admin',
                'foto' => 'assets/img/avatar.jpg',
                'posisi' => 4,
            ],
        ];
        foreach ($aparatur as $item) {
            Aparatur::create([
                'nama' => $item['nama'],
                'jabatan' => $item['jabatan'],
                'foto' => $item['foto'],
                'posisi' => $item['posisi'],
            ]);
        }
    }
}
