<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAbk extends Model
{
    use HasFactory;

    protected $table = 'jenis_abk';
    protected $guard = ["id"];
    protected $fillable = ['kode_abk', 'nama_abk'];

    public function fillTable()
    {
        $jenis_abk = [
            ['kode_abk' => 'A01', 'nama_abk' => 'Kategori Ringan'],
            ['kode_abk' => 'A02', 'nama_abk' => 'Kategori Sedang'],
            ['kode_abk' => 'A03', 'nama_abk' => 'Kategori Benar']
        ];
        return $jenis_abk;
    }
}
