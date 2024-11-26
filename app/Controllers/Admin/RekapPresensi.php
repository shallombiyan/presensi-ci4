<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PresensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapPresensi extends BaseController
{
    public function rekap_harian()
    {
        $presensi_model = new PresensiModel();
        $filter_tanggal = $this->request->getVar('filter_tanggal');
    
        // Default nilai $rekap_harian
        $rekap_harian = [];
    
        // Jika tombol Export Excel ditekan
        if ($this->request->getVar('excel')) {
            $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);
    
            // Membuat spreadsheet menggunakan PhpSpreadsheet
            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();
    
            // Mengatur header
            $spreadsheet->getActiveSheet()->mergeCells('A1:C1');
            $spreadsheet->getActiveSheet()->mergeCells('A3:B3');
            $spreadsheet->getActiveSheet()->mergeCells('C3:E3');
    
            $activeWorksheet->setCellValue('A1', 'REKAP PRESENSI HARIAN');
            $activeWorksheet->setCellValue('A3', 'TANGGAL');
            $activeWorksheet->setCellValue('C3', $filter_tanggal);
            $activeWorksheet->setCellValue('A4', 'NO');
            $activeWorksheet->setCellValue('B4', 'NAMA PEGAWAI');
            $activeWorksheet->setCellValue('C4', 'TANGGAL MASUK');
            $activeWorksheet->setCellValue('D4', 'JAM MASUK');
            $activeWorksheet->setCellValue('E4', 'TANGGAL KELUAR');
            $activeWorksheet->setCellValue('F4', 'JAM KELUAR');
            $activeWorksheet->setCellValue('G4', 'TOTAL JAM KERJA');
            $activeWorksheet->setCellValue('H4', 'TOTAL KETERLAMBAT');
    
            // Mengisi data ke spreadsheet
            $rows = 5;
            $no   = 1;
    
            foreach ($rekap_harian as $rekap) {
                $timestamp_jam_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                $timestamp_jam_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                $selisih = $timestamp_jam_keluar - $timestamp_jam_masuk;
                $jam = floor($selisih / 3600);
                $selisih -= $jam * 3600;
                $menit = floor($selisih / 60);
    
                // Menghitung keterlambatan
                $jam_masuk_real = strtotime($rekap['jam_masuk']);
                $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
                $jam_terlambat = floor($selisih_terlambat / 3600);
                $selisih_terlambat -= $jam_terlambat * 3600;
                $menit_terlambat = floor($selisih_terlambat / 60);
    
                $activeWorksheet->setCellValue('A' . $rows, $no++);
                $activeWorksheet->setCellValue('B' . $rows, $rekap['nama']);
                $activeWorksheet->setCellValue('C' . $rows, $rekap['tanggal_masuk']);
                $activeWorksheet->setCellValue('D' . $rows, $rekap['jam_masuk']);
                $activeWorksheet->setCellValue('E' . $rows, $rekap['tanggal_keluar']);
                $activeWorksheet->setCellValue('F' . $rows, $rekap['jam_keluar']);
                $activeWorksheet->setCellValue('G' . $rows, $jam . ' jam ' . $menit . ' menit ');
                $activeWorksheet->setCellValue('H' . $rows, $jam_terlambat . ' jam ' . $menit_terlambat . ' menit ');
                $rows++;
            }
    
            // Mengirim file Excel ke browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="rekap_presensi_harian.xlsx"');
            header('Cache-Control: max-age=0');
    
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit; // Berhenti di sini agar tidak melanjutkan ke view
        }
    
        // Jika tombol Tampilkan ditekan
        if ($filter_tanggal) {
            $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);
        } else {
            $rekap_harian = $presensi_model->rekap_harian();
        }
    
        // Menyiapkan data untuk view
        $data = [
            'title' => 'Rekap Harian',
            'tanggal' => $filter_tanggal,
            'rekap_harian' => $rekap_harian
        ];
    
        return view('admin/rekap_presensi/rekap_harian', $data);
    }    

    public function rekap_bulanan()
    {
        $presensi_model = new PresensiModel();
        $filter_bulan = $this->request->getVar('filter_bulan');
        $filter_tahun = $this->request->getVar('filter_tahun');
        $rekap_bulanan = [];
    
        // Cek jika tombol Export Excel ditekan
        if ($this->request->getVar('excel')) {
            $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
    
            // Membuat spreadsheet menggunakan PhpSpreadsheet
            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();
    
            // Mengatur header file Excel
            $spreadsheet->getActiveSheet()->mergeCells('A1:H1');
            $activeWorksheet->setCellValue('A1', 'REKAP PRESENSI BULANAN');
            $activeWorksheet->setCellValue('A2', 'Bulan: ' . $filter_bulan . ' Tahun: ' . $filter_tahun);
            $activeWorksheet->setCellValue('A4', 'NO');
            $activeWorksheet->setCellValue('B4', 'NAMA PEGAWAI');
            $activeWorksheet->setCellValue('C4', 'TANGGAL MASUK');
            $activeWorksheet->setCellValue('D4', 'JAM MASUK');
            $activeWorksheet->setCellValue('E4', 'TANGGAL KELUAR');
            $activeWorksheet->setCellValue('F4', 'JAM KELUAR');
            $activeWorksheet->setCellValue('G4', 'TOTAL JAM KERJA');
            $activeWorksheet->setCellValue('H4', 'TOTAL KETERLAMBATAN');
    
            // Mengisi data ke dalam file Excel
            $rows = 5;
            $no = 1;
    
            foreach ($rekap_bulanan as $rekap) {
                // Menghitung total jam kerja
                $timestamp_jam_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                $timestamp_jam_keluar = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                $selisih = $timestamp_jam_keluar - $timestamp_jam_masuk;
                $jam = floor($selisih / 3600);
                $selisih -= $jam * 3600;
                $menit = floor($selisih / 60);
    
                // Menghitung total keterlambatan
                $jam_masuk_real = strtotime($rekap['jam_masuk']);
                $jam_masuk_kantor = strtotime($rekap['jam_masuk_kantor']);
                $selisih_terlambat = max($jam_masuk_real - $jam_masuk_kantor, 0); // Hanya hitung jika terlambat
                $jam_terlambat = floor($selisih_terlambat / 3600);
                $selisih_terlambat -= $jam_terlambat * 3600;
                $menit_terlambat = floor($selisih_terlambat / 60);
    
                $activeWorksheet->setCellValue('A' . $rows, $no++);
                $activeWorksheet->setCellValue('B' . $rows, $rekap['nama']);
                $activeWorksheet->setCellValue('C' . $rows, $rekap['tanggal_masuk']);
                $activeWorksheet->setCellValue('D' . $rows, $rekap['jam_masuk']);
                $activeWorksheet->setCellValue('E' . $rows, $rekap['tanggal_keluar']);
                $activeWorksheet->setCellValue('F' . $rows, $rekap['jam_keluar']);
                $activeWorksheet->setCellValue('G' . $rows, $jam . ' jam ' . $menit . ' menit');
                $activeWorksheet->setCellValue('H' . $rows, $jam_terlambat . ' jam ' . $menit_terlambat . ' menit');
                $rows++;
            }
    
            // Mengirim file Excel ke browser
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="rekap_presensi_bulanan.xlsx"');
            header('Cache-Control: max-age=0');
    
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit; // Menghentikan proses agar tidak memuat view
        }
    
        // Jika tombol "Tampilkan" ditekan atau tidak ada parameter
        if ($filter_bulan && $filter_tahun) {
            $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
        } else {
            $rekap_bulanan = $presensi_model->rekap_bulanan();
        }
    
        // Data untuk view
        $data = [
            'title' => 'Rekap Bulanan',
            'bulan' => $filter_bulan,
            'tahun' => $filter_tahun,
            'rekap_bulanan' => $rekap_bulanan,
        ];
    
        return view('admin/rekap_presensi/rekap_bulanan', $data);
    }
    
}