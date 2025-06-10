<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PoinObservasi extends Model
{
    protected $table = 'poin_observasi';
    protected $primaryKey = 'id_poin';
    protected $fillable = ['aspek', 'deskripsi', 'skor'];

    public function jawaban()
    {
        return $this->hasMany(JawabanObservasi::class, 'id_poin');
    }
}
