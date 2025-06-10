<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    protected $table = 'aturan';
    protected $primaryKey = 'id_aturan';
    protected $fillable = ['kondisi', 'kategori', 'rekomendasi'];
}
