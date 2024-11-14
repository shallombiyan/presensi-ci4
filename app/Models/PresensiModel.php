<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'presensi';
    protected $allowedFields    = [
        'id_pegawai',
        'tanggal_masuk',
        'jam_masuk',
        'foto_masuk',
        'tanggal_keluar',
        'jam_keluar',
        'foto_keluar',
    ];
}
