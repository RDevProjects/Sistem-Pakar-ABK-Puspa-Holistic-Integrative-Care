<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;
    protected $table = 'keputusan';
    protected $guard = ["id"];

    public function jenis_abk()
    {
        return $this->hasMany(JenisAbk::class, 'kode_abk', 'kode_abk');
    }

    public function gejala()
    {
        return $this->hasMany(Gejala::class, 'kode_gejala', 'kode_gejala');
    }

    public function fillTable()
    {
        $keputusan = [
            // Autisme - A01
            ['kode_abk' => 'A01', 'kode_gejala' => 'G001', 'mb' => 0.9, 'md' => 0.1],
            ['kode_abk' => 'A01', 'kode_gejala' => 'G002', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A01', 'kode_gejala' => 'G003', 'mb' => 0.9, 'md' => 0.1],
            ['kode_abk' => 'A01', 'kode_gejala' => 'G004', 'mb' => 0.85, 'md' => 0.1],
            ['kode_abk' => 'A01', 'kode_gejala' => 'G008', 'mb' => 0.85, 'md' => 0.1],
            ['kode_abk' => 'A01', 'kode_gejala' => 'G011', 'mb' => 0.95, 'md' => 0.05],

            // Disleksia - A02
            ['kode_abk' => 'A02', 'kode_gejala' => 'G018', 'mb' => 0.9, 'md' => 0.05],
            ['kode_abk' => 'A02', 'kode_gejala' => 'G019', 'mb' => 0.85, 'md' => 0.1],
            ['kode_abk' => 'A02', 'kode_gejala' => 'G023', 'mb' => 0.8, 'md' => 0.1],
            ['kode_abk' => 'A02', 'kode_gejala' => 'G024', 'mb' => 0.75, 'md' => 0.1],

            // ADHD - A03
            ['kode_abk' => 'A03', 'kode_gejala' => 'G005', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A03', 'kode_gejala' => 'G006', 'mb' => 0.9, 'md' => 0.1],
            ['kode_abk' => 'A03', 'kode_gejala' => 'G017', 'mb' => 0.85, 'md' => 0.1],
            ['kode_abk' => 'A03', 'kode_gejala' => 'G016', 'mb' => 0.8, 'md' => 0.1],

            // Dyscalculia - A04
            ['kode_abk' => 'A04', 'kode_gejala' => 'G019', 'mb' => 0.9, 'md' => 0.05],
            ['kode_abk' => 'A04', 'kode_gejala' => 'G023', 'mb' => 0.85, 'md' => 0.05],
            ['kode_abk' => 'A04', 'kode_gejala' => 'G027', 'mb' => 0.8, 'md' => 0.1],

            // Dysgraphia - A05
            ['kode_abk' => 'A05', 'kode_gejala' => 'G018', 'mb' => 0.85, 'md' => 0.05],
            ['kode_abk' => 'A05', 'kode_gejala' => 'G024', 'mb' => 0.8, 'md' => 0.1],
            ['kode_abk' => 'A05', 'kode_gejala' => 'G027', 'mb' => 0.85, 'md' => 0.05],

            // Asperger Syndrome - A06
            ['kode_abk' => 'A06', 'kode_gejala' => 'G003', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A06', 'kode_gejala' => 'G008', 'mb' => 0.9, 'md' => 0.05],
            ['kode_abk' => 'A06', 'kode_gejala' => 'G020', 'mb' => 0.9, 'md' => 0.1],

            // Sensory Processing Disorder - A07
            ['kode_abk' => 'A07', 'kode_gejala' => 'G021', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A07', 'kode_gejala' => 'G025', 'mb' => 0.9, 'md' => 0.05],
            ['kode_abk' => 'A07', 'kode_gejala' => 'G028', 'mb' => 0.95, 'md' => 0.05],

            // Nonverbal Learning Disorder - A08
            ['kode_abk' => 'A08', 'kode_gejala' => 'G001', 'mb' => 0.8, 'md' => 0.1],
            ['kode_abk' => 'A08', 'kode_gejala' => 'G013', 'mb' => 0.85, 'md' => 0.05],
            ['kode_abk' => 'A08', 'kode_gejala' => 'G014', 'mb' => 0.9, 'md' => 0.05],

            // Oppositional Defiant Disorder - A09
            ['kode_abk' => 'A09', 'kode_gejala' => 'G009', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A09', 'kode_gejala' => 'G016', 'mb' => 0.85, 'md' => 0.05],
            ['kode_abk' => 'A09', 'kode_gejala' => 'G017', 'mb' => 0.9, 'md' => 0.05],

            // Conduct Disorder - A10
            ['kode_abk' => 'A10', 'kode_gejala' => 'G009', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A10', 'kode_gejala' => 'G029', 'mb' => 0.85, 'md' => 0.05],
            ['kode_abk' => 'A10', 'kode_gejala' => 'G030', 'mb' => 0.9, 'md' => 0.05],

            // Bipolar Disorder - A11
            ['kode_abk' => 'A11', 'kode_gejala' => 'G016', 'mb' => 0.9, 'md' => 0.05],
            ['kode_abk' => 'A11', 'kode_gejala' => 'G017', 'mb' => 0.85, 'md' => 0.05],
            ['kode_abk' => 'A11', 'kode_gejala' => 'G022', 'mb' => 0.8, 'md' => 0.05],

            // Anxiety Disorders - A12
            ['kode_abk' => 'A12', 'kode_gejala' => 'G022', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A12', 'kode_gejala' => 'G014', 'mb' => 0.9, 'md' => 0.05],
            ['kode_abk' => 'A12', 'kode_gejala' => 'G020', 'mb' => 0.85, 'md' => 0.05],

            // OCD - A13
            ['kode_abk' => 'A13', 'kode_gejala' => 'G004', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A13', 'kode_gejala' => 'G028', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A13', 'kode_gejala' => 'G012', 'mb' => 0.9, 'md' => 0.05],

            // Tourette Syndrome - A14
            ['kode_abk' => 'A14', 'kode_gejala' => 'G028', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A14', 'kode_gejala' => 'G026', 'mb' => 0.9, 'md' => 0.05],
            ['kode_abk' => 'A14', 'kode_gejala' => 'G004', 'mb' => 0.85, 'md' => 0.05],

            // Schizophrenia - A15
            ['kode_abk' => 'A15', 'kode_gejala' => 'G029', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A15', 'kode_gejala' => 'G030', 'mb' => 0.95, 'md' => 0.05],
            ['kode_abk' => 'A15', 'kode_gejala' => 'G014', 'mb' => 0.9, 'md' => 0.05],
        ];

        return $keputusan;
    }
}
