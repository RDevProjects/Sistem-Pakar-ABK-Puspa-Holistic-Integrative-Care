<?php

namespace Database\Seeders;

use App\Models\Gejala;
use App\Models\JenisAbk;
use App\Models\Keputusan;
use App\Models\KondisiUser;
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

        User::factory()->create([
            'name' => 'Admin Sistem',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'User Sistem',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $keputusan = new Keputusan();
        $gejala = new Gejala();
        $jenis_abk = new JenisAbk();
        $kondisi = new KondisiUser();

        Keputusan::insert($keputusan->fillTable());
        Gejala::insert($gejala->fillTable());
        JenisAbk::insert($jenis_abk->fillTable());
        KondisiUser::insert($kondisi->fillTable());
    }
}
