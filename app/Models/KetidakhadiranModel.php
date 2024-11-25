<?php

namespace App\Models;

use CodeIgniter\Model;

class KetidakhadiranModel extends Model
{
    protected $table            = 'ketidakhadiran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id_pegawai',
        'keterangan',
        'tanggal',
        'deskripsi',
        'file',
        'status'
    ];
}
