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
            ['kode_abk' => 'A01', 'nama_abk' => 'Autisme'],
            ['kode_abk' => 'A02', 'nama_abk' => 'Disleksia'],
            ['kode_abk' => 'A03', 'nama_abk' => 'ADHD'],
            ['kode_abk' => 'A04', 'nama_abk' => 'Dyscalculia'],
            ['kode_abk' => 'A05', 'nama_abk' => 'Dysgraphia'],
            ['kode_abk' => 'A06', 'nama_abk' => 'Asperger Syndrome'],
            ['kode_abk' => 'A07', 'nama_abk' => 'Sensory Processing Disorder'],
            ['kode_abk' => 'A08', 'nama_abk' => 'Nonverbal Learning Disorder'],
            ['kode_abk' => 'A09', 'nama_abk' => 'Oppositional Defiant Disorder'],
            ['kode_abk' => 'A10', 'nama_abk' => 'Conduct Disorder'],
            ['kode_abk' => 'A11', 'nama_abk' => 'Bipolar Disorder'],
            ['kode_abk' => 'A12', 'nama_abk' => 'Anxiety Disorders'],
            ['kode_abk' => 'A13', 'nama_abk' => 'Obsessive-Compulsive Disorder (OCD)'],
            ['kode_abk' => 'A14', 'nama_abk' => 'Tourette Syndrome'],
            ['kode_abk' => 'A15', 'nama_abk' => 'Schizophrenia']
        ];
        return $jenis_abk;
    }
}
