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

    public function rekap_harian(){
        $db      = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('tanggal_masuk', date('Y-m-d'));
        return $query = $builder->get()->getResultArray();
    }

    public function rekap_harian_filter($filter_tanggal){
        $db      = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('tanggal_masuk', $filter_tanggal);
        return $query = $builder->get()->getResultArray();
    }

    public function rekap_bulanan(){
        $db      = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('MONTH(tanggal_masuk)', date('m'));
        $builder->where('YEAR(tanggal_masuk)', date('Y'));
        return $query = $builder->get()->getResultArray();
    }

    public function rekap_bulanan_filter($filter_bulan, $filter_tahun){
        $db      = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('MONTH(tanggal_masuk)', $filter_bulan);
        $builder->where('YEAR(tanggal_masuk)',$filter_tahun);
        return $query = $builder->get()->getResultArray();
    }

    public function rekap_presensi_pegawai() {
        // Ambil id_pegawai dari session
        $id_pegawai = (int) session()->get('id_pegawai');
    
       
        // Buat query
        $db = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('presensi.id_pegawai', $id_pegawai);
    
        // Eksekusi query dan debug hasilnya
        return ($query = $builder->get()->getResultArray());
        
    }

     public function rekap_presensi_pegawai_filter($filter_tanggal) {
        // Ambil id_pegawai dari session
        $id_pegawai = (int) session()->get('id_pegawai');
        // Buat query
        $db = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('presensi.id_pegawai', $id_pegawai);
        $builder->where('tanggal_masuk', $filter_tanggal);
    
        // Eksekusi query dan debug hasilnya
        return $query = $builder->get()->getResultArray();
        
    }
    

}