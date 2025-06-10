<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;
    protected $table = 'gejala_abk';
    protected $guard = ["id"];
    protected $fillable = ["kode_gejala", "nama_gejala"];

    public function fillTable()
    {
        $gejala_abk = [
            ["kode_gejala" => "G001", "nama_gejala" => "Hiperaktif atau bergerak tidak bertujuan"],
            ["kode_gejala" => "G002", "nama_gejala" => "Hipoaktif atau lamban gerak"],
            ["kode_gejala" => "G003", "nama_gejala" => "Tidak mampu mengikuti aturan"],
            ["kode_gejala" => "G004", "nama_gejala" => "Menyakiti diri sendiri"],
            ["kode_gejala" => "G005", "nama_gejala" => "Menyerang orang lain ketika marah"],
            ["kode_gejala" => "G006", "nama_gejala" => "Perilaku Repetitif atau berulang-ulang"],
            ["kode_gejala" => "G007", "nama_gejala" => "Tidak dapat duduk tenang"],
            ["kode_gejala" => "G008", "nama_gejala" => "Anak Jalan jinjit"],
            ["kode_gejala" => "G009", "nama_gejala" => "Kelainan pada anggota tubuh atau pemakaian alat bantu"],
            ["kode_gejala" => "G010", "nama_gejala" => "Tidak mampu melompat"],
            ["kode_gejala" => "G011", "nama_gejala" => "Tidak mampu mengikuti contoh gerakan seperti senam"],
            ["kode_gejala" => "G012", "nama_gejala" => "Tidak mampu membuat bentuk sederhana dari playdough"],
            ["kode_gejala" => "G013", "nama_gejala" => "Tidak mampu merobek kertas"],
            ["kode_gejala" => "G014", "nama_gejala" => "Saat ditanya mengulang pertanyaan atau perkataan"],
            ["kode_gejala" => "G015", "nama_gejala" => "Tidak Mampu memahami perintah/instruksi"],
            ["kode_gejala" => "G016", "nama_gejala" => "Tidak Mampu berkomunikasi 2 arah/tanya jawab"],
            ["kode_gejala" => "G017", "nama_gejala" => "Tidak mampu menyelesaikan aktifitas"],
            ["kode_gejala" => "G018", "nama_gejala" => "Tidak mampu mempertahankan atensi dan konsentrasi ketika diberi tugas"],
            ["kode_gejala" => "G019", "nama_gejala" => "Tidak mampu menyebutkan identitas diri dan anggota keluarga"],
            ["kode_gejala" => "G020", "nama_gejala" => "Tidak mampu menamai benda sekitar"],
            ["kode_gejala" => "G021", "nama_gejala" => "Tidak mampu menyebutkan angka 1-5"],
            ["kode_gejala" => "G022", "nama_gejala" => "Tidak mampu mengidentifikasi bentuk (minimal 1 bentuk konsisten)"],
            ["kode_gejala" => "G023", "nama_gejala" => "Tidak mampu mengidentifikasi warna primer"],
            ["kode_gejala" => "G024", "nama_gejala" => "Tidak ada kontak mata/kontak mata minim saat diajak berbicara"],
            ["kode_gejala" => "G025", "nama_gejala" => "Suka menyendiri"],
            ["kode_gejala" => "G026", "nama_gejala" => "Kesulitan beradaptasi dengan lingkungan baru"],
        ];

        return $gejala_abk;
    }
}
