<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiUser extends Model
{
    use HasFactory;
    protected $table = 'kondisi_users';

    public function fillTable()
    {
        $cf_user = [
            [
                'kondisi' => 'Tidak Tahu',
                'nilai' => 0.0,
            ],
            [
                'kondisi' => 'Kurang Yakin',
                'nilai' => 0.2,
            ],
            [
                'kondisi' => 'Mungkin',
                'nilai' => 0.4,
            ],
            [
                'kondisi' => 'Cukup Yakin',
                'nilai' => 0.6,
            ],
            [
                'kondisi' => 'Yakin',
                'nilai' => 0.8,
            ],
            [
                'kondisi' => 'Sangat Yakin',
                'nilai' => 1.0,
            ],
        ];
        return $cf_user;
    }
}
