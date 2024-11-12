<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $allowedFields    = [
        'nip',
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_handphone',
        'jabatan',
        'lokasi_presensi',
        'foto'
    ];

    public function detailPegawai($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pegawai');
        $builder->select('pegawai.*, users.username, users.status, users.role');
        $builder->join('users', 'users.id_pegawai = pegawai.id');
        $builder->where('pegawai.id', $id);
        return $builder->get()->getRowArray();
    }

    public function editPegawai($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('pegawai');
        $builder->select('pegawai.*, users.username, users.password, users.status, users.role');
        $builder->join('users', 'users.id_pegawai = pegawai.id');
        $builder->where('pegawai.id', $id);
        return $builder->get()->getRowArray();
    }

}