<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanObservasi extends Model
{
    protected $table = 'jawaban_observasi';
    protected $primaryKey = 'id_jawaban';
    protected $fillable = ['id_observasi', 'id_poin', 'jawaban', 'mb', 'md', 'cf', 'skor_hasil', 'keterangan'];

    public function observasi()
    {
        return $this->belongsTo(Observasi::class, 'id_observasi');
    }

    public function poin()
    {
        return $this->belongsTo(PoinObservasi::class, 'id_poin');
    }
}
