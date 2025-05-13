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
            ["kode_gejala" => "G001", "nama_gejala" => "Kesulitan berbicara atau lambat bicara"],
            ["kode_gejala" => "G002", "nama_gejala" => "Tidak merespon saat dipanggil"],
            ["kode_gejala" => "G003", "nama_gejala" => "Tidak mampu melakukan kontak mata"],
            ["kode_gejala" => "G004", "nama_gejala" => "Sering mengulang kata atau gerakan"],
            ["kode_gejala" => "G005", "nama_gejala" => "Kesulitan fokus atau mudah terdistraksi"],
            ["kode_gejala" => "G006", "nama_gejala" => "Terlalu aktif dan tidak bisa diam"],
            ["kode_gejala" => "G007", "nama_gejala" => "Kesulitan memahami instruksi sederhana"],
            ["kode_gejala" => "G008", "nama_gejala" => "Kesulitan bersosialisasi dengan teman sebaya"],
            ["kode_gejala" => "G009", "nama_gejala" => "Sering tantrum atau marah berlebihan"],
            ["kode_gejala" => "G010", "nama_gejala" => "Gerakan tubuh tidak terkoordinasi (motorik kasar terganggu)"],
            ["kode_gejala" => "G011", "nama_gejala" => "Tidak menunjukkan minat bermain dengan orang lain"],
            ["kode_gejala" => "G012", "nama_gejala" => "Menunjukkan ketertarikan berlebihan pada objek tertentu"],
            ["kode_gejala" => "G013", "nama_gejala" => "Tidak dapat mengungkapkan perasaan dengan kata-kata"],
            ["kode_gejala" => "G014", "nama_gejala" => "Sering menyendiri atau menarik diri dari lingkungan"],
            ["kode_gejala" => "G015", "nama_gejala" => "Tidak mampu mengikuti rutinitas harian dengan baik"],
            ["kode_gejala" => "G016", "nama_gejala" => "Sulit mengontrol emosi"],
            ["kode_gejala" => "G017", "nama_gejala" => "Sering menunjukkan perilaku impulsif"],
            ["kode_gejala" => "G018", "nama_gejala" => "Kesulitan membaca atau menulis di usia sekolah"],
            ["kode_gejala" => "G019", "nama_gejala" => "Tidak bisa membedakan huruf atau angka"],
            ["kode_gejala" => "G020", "nama_gejala" => "Menghindari kontak sosial secara konsisten"],
            ["kode_gejala" => "G021", "nama_gejala" => "Reaksi berlebihan terhadap suara atau cahaya"],
            ["kode_gejala" => "G022", "nama_gejala" => "Kurang percaya diri atau takut mencoba hal baru"],
            ["kode_gejala" => "G023", "nama_gejala" => "Memiliki kesulitan menyelesaikan tugas sederhana"],
            ["kode_gejala" => "G024", "nama_gejala" => "Berbicara dengan cara yang aneh atau tidak wajar"],
            ["kode_gejala" => "G025", "nama_gejala" => "Menolak disentuh atau bersentuhan dengan orang lain"],
            ["kode_gejala" => "G026", "nama_gejala" => "Tidak menunjukkan ekspresi wajah sesuai situasi"],
            ["kode_gejala" => "G027", "nama_gejala" => "Kesulitan mengontrol gerakan halus (motorik halus terganggu)"],
            ["kode_gejala" => "G028", "nama_gejala" => "Menunjukkan gerakan tubuh berulang (flapping, rocking)"],
            ["kode_gejala" => "G029", "nama_gejala" => "Sering berbicara sendiri atau dalam bahasa yang tidak dipahami"],
            ["kode_gejala" => "G030", "nama_gejala" => "Sering tersesat meski sudah diajarkan arah atau lokasi"],
        ];

        return $gejala_abk;
    }
}
