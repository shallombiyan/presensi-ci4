<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;
use App\Models\PresensiModel;
use CodeIgniter\HTTP\ResponseInterface;

class RekapPresensi extends BaseController
{
    public function index()
    {
        $presensiModel = new PresensiModel;
        $filter_tanggal = $this->request->getVar('filter_tanggal');
        if ($filter_tanggal) {
            $rekap_presensi = $presensiModel->rekap_presensi_pegawai_filter($filter_tanggal);
        } else {
            $rekap_presensi = $presensiModel->rekap_presensi_pegawai();
        }
        $data = [
            'title' => 'Rekap Presensi',
            'rekap_presensi' => $rekap_presensi // Hasil query
        ];
    
        return view('pegawai/rekap_presensi', $data);
    }
}