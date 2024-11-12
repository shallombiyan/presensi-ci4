<?php

namespace App\Controllers\admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PegawaiModel;
use App\Models\UserModel;
use App\Models\LokasiPresensiModel;
use App\Models\JabatanModel;

class DataPegawai extends BaseController
{
    public function index()
    {
        $pegawaiModel = new PegawaiModel();
        $data = [
            'title'   => 'Data Pegawai',
            'pegawai' => $pegawaiModel->findAll()
        ];

        return view('admin/data_pegawai/data_pegawai', $data);
    }

    public function detail($id)
    {
        $pegawaiModel = new PegawaiModel();
        $pegawai = $pegawaiModel->detailPegawai($id);

        if (!$pegawai) {
            session()->setFlashdata('error', 'Data Pegawai Tidak Ditemukan');
            return redirect()->to(base_url('admin/pegawai'));
        }

        $data = [
            'title'   => 'Detail Pegawai',
            'pegawai' => $pegawai
        ];
        return view('admin/data_pegawai/detail', $data);
    }

    public function create()
    {
        $lokasi_presensi = new LokasiPresensiModel();
        $jabatan_model = new JabatanModel();
        $data = [
            'title'            => 'Tambah Pegawai',
            'lokasi_presensi'  => $lokasi_presensi->findAll(),
            'jabatan'          => $jabatan_model->findAll(),
            'validation'       => \Config\Services::validation()
        ];
        return view('admin/data_pegawai/create', $data);
    }
    
    public function generateNIP()
    {
        $pegawaiModel = new PegawaiModel();
        $pegawaiTerakhir = $pegawaiModel->select('nip')->orderBy('id', 'DESC')->first();
        $nipTerakhir = $pegawaiTerakhir ? $pegawaiTerakhir['nip'] : 'peg-0000';
        $angkaNIP = (int) substr($nipTerakhir, 4);
        $angkaNIP++;
        return 'PEG-' . str_pad($angkaNIP, 4, '0', STR_PAD_LEFT);
    }

    public function store()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pegawai Wajib Diisi',
                ],
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Wajib Diisi',
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Wajib Diisi',
                ],
            ],
            'no_handphone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. Handphone Wajib Diisi',
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Wajib Diisi',
                ],
            ],
            'lokasi_presensi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi Presensi Wajib Diisi',
                ],
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'uploaded' => 'file foto wajib diupload!',
                    'max_size' => 'Ukuran foto melebihi 10MB',
                    'mime_in'  => '"Jenis file yang diizinkan hanya PNG atau JPEG',
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'username Wajib Diisi',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Wajib Diisi',
                ],
            ],
            'konfirmasi_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi Password Wajib Diisi',
                    'matches' => "Konfirmasi password tidak cocok",
                ],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role Wajib Diisi',
                ],
            ],

        ];

        if (!$this->validate($rules)) {
            $lokasi_presensi = new LokasiPresensiModel();
            $jabatan_model = new JabatanModel();
            $data = [
                'title'            => 'Tambah Pegawai',
                'lokasi_presensi'  => $lokasi_presensi->findAll(),
                'jabatan'          => $jabatan_model->findAll(),
                'validation'       => \Config\Services::validation()
            ];
            return view('admin/data_pegawai/create', $data);
        } 

        $pegawaiModel = new PegawaiModel();
        $nipBaru = $this->generateNIP();


        $foto = $this->request->getFile('foto');

        if ($foto -> getError() == 4) {
            $nama_foto = '';
        } else {
            $nama_foto = $foto->getRandomName(); 
            $foto->move('profile', $nama_foto);
        }
        $pegawaiModel = new PegawaiModel();
        $pegawaiModel->insert([
            'nip' => $nipBaru,
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'no_handphone' => $this->request->getPost('no_handphone'),
            'jabatan' => $this->request->getPost('jabatan'),
            'lokasi_presensi' => $this->request->getPost('lokasi_presensi'),
            'foto' => $nama_foto,
        ]);

        $id_pegawai = $pegawaiModel->insertID();

        $userModel = new UserModel();
        $userModel->insert([
            'id_pegawai' => $id_pegawai,
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'status' => 'Aktif',
            'role' => $this->request->getPost('role'),
        ]);

        session()->setFlashdata('berhasil', 'Data Pegawai Berhasil Tersimpan');

        return redirect()->to(base_url('admin/data_pegawai'));
    }

    public function edit($id)
    {

        $lokasi_presensi = new LokasiPresensiModel();
        $jabatan_model = new JabatanModel();
        $pegawaiModel = new PegawaiModel();
        $data = [
            'title'            => 'Tambah Pegawai',
            'pegawai' => $pegawaiModel->editPegawai($id),
            'lokasi_presensi'  => $lokasi_presensi->findAll(),
            'jabatan'          => $jabatan_model->findAll(),
            'validation'       => \Config\Services::validation()
        ];
        return view('admin/data_pegawai/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Pegawai Wajib Diisi',
                ],
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Kelamin Wajib Diisi',
                ],
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat Wajib Diisi',
                ],
            ],
            'no_handphone' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. Handphone Wajib Diisi',
                ],
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jabatan Wajib Diisi',
                ],
            ],
            'lokasi_presensi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Lokasi Presensi Wajib Diisi',
                ],
            ],
            'foto' => [
                'rules' => 'permit_empty|max_size[foto,10240]|mime_in[foto,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Ukuran foto melebihi 10MB',
                    'mime_in'  => 'Jenis file yang diizinkan hanya PNG atau JPEG',
                ],
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username Wajib Diisi',
                ],
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role Wajib Diisi',
                ],
            ],
        ];
    
        if (!$this->validate($rules)) {
            // Rest of the code for handling validation failure...
        }
    
        $pegawaiModel = new PegawaiModel();
        $userModel = new UserModel();
        $foto = $this->request->getFile('foto');
    
        if ($foto->getError() == 4) {
            $nama_foto = $this->request->getPost('foto_lama');
        } else {
            $nama_foto = $foto->getRandomName();
            $foto->move('profile', $nama_foto);
        }
    
        $pegawaiModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'no_handphone' => $this->request->getPost('no_handphone'),
            'jabatan' => $this->request->getPost('jabatan'),
            'lokasi_presensi' => $this->request->getPost('lokasi_presensi'),
            'foto' => $nama_foto,
        ]);
    
        if ($this->request->getPost('password') == '') {
            $password = $this->request->getPost('password_lama');
        } else {
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
    
        $userModel
            ->where('id_pegawai', $id)
            ->set([
                'username' => $this->request->getPost('username'),
                'password' => $password,
                'status' => $this->request->getPost('status'),
                'role' => $this->request->getPost('role'),
            ])
            ->update();
    
        session()->setFlashdata('berhasil', 'Data Pegawai Berhasil Diperbarui');
    
        return redirect()->to(base_url('admin/data_pegawai'));
    }
    
    public function delete($id)
    {
        $pegawaiModel = new PegawaiModel();
        $userModel = new UserModel();
        $pegawai = $pegawaiModel->find($id);

        if($pegawai) {
            $userModel->where('id_pegawai', $id)->delete();
            $pegawaiModel->delete($id);
            session()->setFlashdata('berhasil', 'Data Pegawai Berhasil Dihapus');

            return redirect()->to(base_url('admin/data_pegawai'));
        }
    }
}