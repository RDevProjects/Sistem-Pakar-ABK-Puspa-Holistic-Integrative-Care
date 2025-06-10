<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilObservasi extends Model
{
    protected $table = 'hasil_observasi';
    protected $primaryKey = 'id_hasil';
    protected $fillable = ['id_observasi', 'total_skor', 'kategori', 'rekomendasi', 'kesimpulan'];

    public function observasi()
    {
        return $this->belongsTo(Observasi::class, 'id_observasi');
    }
}
