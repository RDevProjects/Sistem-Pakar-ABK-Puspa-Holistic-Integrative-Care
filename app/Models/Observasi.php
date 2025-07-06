<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Observasi extends Model
{
    protected $table = 'observasi';
    protected $primaryKey = 'id_observasi';
    protected $fillable = ['nama_anak', 'usia', 'tanggal', 'koordinator', 'observer', 'user_id'];

    public function jawaban()
    {
        return $this->hasMany(JawabanObservasi::class, 'id_observasi');
    }

    public function hasil()
    {
        return $this->hasMany(HasilObservasi::class, 'id_observasi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
