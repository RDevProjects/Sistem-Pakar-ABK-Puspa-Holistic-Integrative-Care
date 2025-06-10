<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoinObservasiSeeder extends Seeder
{
    public function run()
    {
        $poin = [
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Hiperaktif atau bergerak tidak bertujuan', 'skor' => 3],
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Hipoaktif atau lamban gerak', 'skor' => 3],
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Tidak mampu mengikuti aturan', 'skor' => 2],
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Menyakiti diri sendiri', 'skor' => 3],
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Menyerang orang lain ketika marah', 'skor' => 1],
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Perilaku Repetitif atau berulang-ulang', 'skor' => 3],
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Tidak dapat duduk tenang', 'skor' => 1],
            ['aspek' => 'Perilaku dan Emosi', 'deskripsi' => 'Anak Jalan jinjit', 'skor' => 2],
            ['aspek' => 'Fisik dan Motorik', 'deskripsi' => 'Kelainan pada anggota tubuh atau pemakaian alat bantu', 'skor' => 1],
            ['aspek' => 'Fisik dan Motorik', 'deskripsi' => 'Tidak mampu melompat', 'skor' => 2],
            ['aspek' => 'Fisik dan Motorik', 'deskripsi' => 'Tidak mampu mengikuti contoh gerakan seperti senam', 'skor' => 1],
            ['aspek' => 'Fisik dan Motorik', 'deskripsi' => 'Tidak mampu membuat bentuk sederhana dari playdough', 'skor' => 2],
            ['aspek' => 'Fisik dan Motorik', 'deskripsi' => 'Tidak mampu merobek kertas', 'skor' => 2],
            ['aspek' => 'Bahasa dan Bicara', 'deskripsi' => 'Saat ditanya mengulang pertanyaan atau perkataan', 'skor' => 1],
            ['aspek' => 'Bahasa dan Bicara', 'deskripsi' => 'Tidak Mampu memahami perintah/instruksi', 'skor' => 2],
            ['aspek' => 'Bahasa dan Bicara', 'deskripsi' => 'Tidak Mampu berkomunikasi 2 arah/tanya jawab', 'skor' => 3],
            ['aspek' => 'Kognitif dan Akademik', 'deskripsi' => 'Tidak mampu menyelesaikan aktifitas', 'skor' => 2],
            ['aspek' => 'Kognitif dan Akademik', 'deskripsi' => 'Tidak mampu mempertahankan atensi dan konsentrasi ketika diberi tugas', 'skor' => 2],
            ['aspek' => 'Kognitif dan Akademik', 'deskripsi' => 'Tidak mampu menyebutkan identitas diri dan anggota keluarga', 'skor' => 3],
            ['aspek' => 'Kognitif dan Akademik', 'deskripsi' => 'Tidak mampu menamai benda sekitar', 'skor' => 3],
            ['aspek' => 'Kognitif dan Akademik', 'deskripsi' => 'Tidak mampu menyebutkan angka 1-5', 'skor' => 1],
            ['aspek' => 'Kognitif dan Akademik', 'deskripsi' => 'Tidak mampu mengidentifikasi bentuk (minimal 1 bentuk konsisten)', 'skor' => 1],
            ['aspek' => 'Kognitif dan Akademik', 'deskripsi' => 'Tidak mampu mengidentifikasi warna primer', 'skor' => 2],
            ['aspek' => 'Sosialisasi', 'deskripsi' => 'Tidak ada kontak mata/kontak mata minim saat diajak berbicara', 'skor' => 2],
            ['aspek' => 'Sosialisasi', 'deskripsi' => 'Suka menyendiri', 'skor' => 1],
            ['aspek' => 'Sosialisasi', 'deskripsi' => 'Kesulitan beradaptasi dengan lingkungan baru', 'skor' => 2],
        ];
        DB::table('poin_observasi')->insert($poin);
    }
}
