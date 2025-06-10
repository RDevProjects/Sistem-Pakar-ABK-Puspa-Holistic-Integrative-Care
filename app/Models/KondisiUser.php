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
                'kondisi' => 'Tidak',
                'nilai' => 0.0,
            ],
            [
                'kondisi' => 'Mungkin',
                'nilai' => 1.0,
            ],
            [
                'kondisi' => 'Cukup Yakin',
                'nilai' => 2.0,
            ],
            [
                'kondisi' => 'Yakin',
                'nilai' => 3.0,
            ],
        ];
        return $cf_user;
    }
}
