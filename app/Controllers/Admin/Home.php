<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;
use App\Models\PresensiModel;
use App\Models\KetidakhadiranModel;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $pegawai_model = new PegawaiModel();
        $presensi_model = new PresensiModel();
        $ketidakhadiran_model = new KetidakhadiranModel();


        $data = [
            'title' => 'Home',
            'total_pegawai' => $pegawai_model->countAllResults(),
            'total_hadir' => $presensi_model->where('tanggal_masuk', date('Y-m-d'))->countAllResults(),
            'ketidakhadiran' => $ketidakhadiran_model->where('tanggal', date('Y-m-d'))->countAllResults()


        ];
        return view('admin/home', $data);
    }
}