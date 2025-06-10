<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AturanSeeder extends Seeder
{
    public function run()
    {
        $aturan = [
            ['kondisi' => 'total_skor < 8', 'kategori' => 'Belum Signifikan', 'rekomendasi' => 'Observasi Lebih Lanjut'],
            ['kondisi' => 'total_skor >= 8 AND total_skor <= 14', 'kategori' => 'Ringan', 'rekomendasi' => 'Asesmen Lanjutan'],
            ['kondisi' => 'total_skor >= 15 AND total_skor <= 21', 'kategori' => 'Sedang', 'rekomendasi' => 'Asesmen Lanjutan'],
            ['kondisi' => 'total_skor > 22', 'kategori' => 'Berat', 'rekomendasi' => 'Asesmen Lanjutan'],
        ];
        DB::table('aturan')->insert($aturan);
    }
}